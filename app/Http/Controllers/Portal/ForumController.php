<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Repositories\Portal\CondominiumRepository;
use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Services\Portal\ForumService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\ForumRequest;
use CentralCondo\Repositories\Portal\ForumRepository;
use CentralCondo\Validators\Portal\ForumValidator;
use CentralCondo\Http\Controllers\Controller;


class ForumController extends Controller
{
    /**
     * @var ForumRepository
     */
    protected $repository;

    /**
     * @var ForumValidator
     */
    protected $validator;

    /**
     * @var ForumService
     */
    private $service;

    /**
     * @var CondominiumRepository
     */
    private $condominiumRepository;

    /**
     * @var UsersCondominiumRepository
     */
    private $usersCondominiumRepository;

    /**
     * ForumController constructor.
     * @param ForumRepository $repository
     * @param ForumValidator $validator
     * @param ForumService $service
     * @param CondominiumRepository $condominiumRepository
     * @param UsersCondominiumRepository $usersCondominiumRepository
     */
    public function __construct(ForumRepository $repository,
                                ForumValidator $validator,
                                ForumService $service,
                                CondominiumRepository $condominiumRepository,
                                UsersCondominiumRepository $usersCondominiumRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->condominiumRepository = $condominiumRepository;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
    }

    public function index()
    {
        $dados = $this->repository->all();
        return view('portal.Forum.index', compact('dados'));
    }

    public function create()
    {
        $condominium = $this->condominiumRepository->listCondominium();
        $usersCondominium = $this->usersCondominiumRepository->all();
        return view('portal.Forum.create', compact('condominium', 'usersCondominium'));
    }

    public function store(ForumRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $dados = $this->repository->find($id);
        $usersCondominium = $this->usersCondominiumRepository->all();
        $condominium = $this->condominiumRepository->listCondominium();

        return view('portal.Forum.edit', compact('dados', 'condominium', 'usersCondominium'));
    }

    public function update(ForumRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'UsersRole deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UsersRole deleted.');
    }
}
