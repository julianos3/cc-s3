<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Repositories\Portal\CondominiumRepository;
use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Services\Portal\ForumResponseService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\ForumResponseRequest;
use CentralCondo\Repositories\Portal\ForumResponseRepository;
use CentralCondo\Validators\Portal\ForumResponseValidator;
use CentralCondo\Http\Controllers\Controller;


class ForumResponseController extends Controller
{
    /**
     * @var ForumResponseRepository
     */
    protected $repository;

    /**
     * @var ForumResponseValidator
     */
    protected $validator;

    /**
     * @var ForumResponseService
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
     * ForumResponseController constructor.
     * @param ForumResponseRepository $repository
     * @param ForumResponseValidator $validator
     * @param ForumResponseService $service
     * @param CondominiumRepository $condominiumRepository
     * @param UsersCondominiumRepository $usersCondominiumRepository
     */
    public function __construct(ForumResponseRepository $repository,
                                ForumResponseValidator $validator,
                                ForumResponseService $service,
                                CondominiumRepository $condominiumRepository,
                                UsersCondominiumRepository $usersCondominiumRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->condominiumRepository = $condominiumRepository;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
    }

    public function index($forumId)
    {
        $dados = $this->repository->findWhere([
            'forum_id' => $forumId
        ]);
        return view('portal.forum.response.index', compact('dados', 'forumId'));
    }

    public function create($forumId)
    {
        $usersCondominium = $this->usersCondominiumRepository->all();
        $response = $this->repository->all();

        return view('portal.forum.response.create', compact('forumId', 'usersCondominium', 'response'));
    }

    public function store(ForumResponseRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($forumId, $id)
    {
        $dados = $this->repository->find($id);
        $usersCondominium = $this->usersCondominiumRepository->all();
        $response = $this->repository->all();

        return view('portal.forum.response.edit', compact('dados', 'forumId', 'usersCondominium', 'response'));
    }

    public function update(ForumResponseRequest $request, $id)
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
