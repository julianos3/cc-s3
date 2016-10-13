<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Repositories\Portal\CondominiumRepository;
use CentralCondo\Repositories\Portal\GroupCondominiumRepository;
use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Services\Portal\LostAndFoundService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\LostAndFoundRequest;
use CentralCondo\Repositories\Portal\LostAndFoundRepository;
use CentralCondo\Validators\Portal\LostAndFoundValidator;
use CentralCondo\Http\Controllers\Controller;


class LostAndFoundController extends Controller
{
    /**
     * @var LostAndFoundRepository
     */
    protected $repository;

    /**
     * @var LostAndFoundValidator
     */
    protected $validator;

    /**
     * @var LostAndFoundService
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
     * @var GroupCondominiumRepository
     */
    private $groupCondominiumRepository;

    /**
     * LostAndFoundController constructor.
     * @param LostAndFoundRepository $repository
     * @param LostAndFoundValidator $validator
     * @param LostAndFoundService $service
     * @param CondominiumRepository $condominiumRepository
     * @param UsersCondominiumRepository $usersCondominiumRepository
     * @param GroupCondominiumRepository $groupCondominiumRepository
     */
    public function __construct(LostAndFoundRepository $repository,
                                LostAndFoundValidator $validator,
                                LostAndFoundService $service,
                                CondominiumRepository $condominiumRepository,
                                UsersCondominiumRepository $usersCondominiumRepository, GroupCondominiumRepository $groupCondominiumRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->condominiumRepository = $condominiumRepository;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
        $this->groupCondominiumRepository = $groupCondominiumRepository;
    }

    public function index()
    {
        $dados = $this->repository->all();
        return view('portal.lost-and-found.index', compact('dados'));
    }

    public function create()
    {
        $condominium = $this->condominiumRepository->listCondominium();
        $usersCondominium = $this->usersCondominiumRepository->all();

        return view('portal.lost-and-found.create', compact('condominium', 'usersCondominium'));
    }

    public function store(LostAndFoundRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $dados = $this->repository->find($id);
        $dados['date'] = date('d/m/Y', strtotime($dados['date']));
        $condominium = $this->condominiumRepository->listCondominium();
        $usersCondominium = $this->usersCondominiumRepository->all();

        return view('portal.lost-and-found.edit', compact('dados', 'condominium', 'usersCondominium'));
    }

    public function update(LostAndFoundRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'LostAndFound' => 'UsersRole deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('LostAndFound', 'UsersRole deleted.');
    }

}
