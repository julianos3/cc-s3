<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Entities\Portal\UsersCondominium;
use CentralCondo\Repositories\Portal\GroupCondominiumRepository;
use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Services\Portal\UsersGroupCondominiumService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\UsersGroupCondominiumRequest;
use CentralCondo\Repositories\Portal\UsersGroupCondominiumRepository;
use CentralCondo\Validators\Portal\UsersGroupCondominiumValidator;
use CentralCondo\Http\Controllers\Controller;

class UsersGroupCondominiumController extends Controller
{
    /**
     * @var UsersGroupCondominiumRepository
     */
    protected $repository;

    /**
     * @var UsersGroupCondominiumValidator
     */
    protected $validator;

    /**
     * @var UsersGroupCondominiumService
     */
    private $service;

    /**
     * @var UsersCondominium
     */
    private $usersCondominiumRepository;

    /**
     * @var GroupCondominiumRepository
     */
    private $groupCondominiumRepository;

    /**
     * UsersGroupCondominiumController constructor.
     * @param UsersGroupCondominiumRepository $repository
     * @param UsersGroupCondominiumValidator $validator
     * @param UsersGroupCondominiumService $service
     * @param UsersCondominium $usersCondominium
     * @param GroupCondominiumRepository $groupCondominiumRepository
     */
    public function __construct(UsersGroupCondominiumRepository $repository,
                                UsersGroupCondominiumValidator $validator,
                                UsersGroupCondominiumService $service,
                                UsersCondominiumRepository $usersCondominium,
                                GroupCondominiumRepository $groupCondominiumRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->usersCondominiumRepository = $usersCondominium;
        $this->groupCondominiumRepository = $groupCondominiumRepository;
    }

    public function index($groupId)
    {
        $dados = $this->repository->findWhere([
            'group_id' => $groupId
        ]);
        return view('portal.condominium.group.user.index', compact('dados', 'groupId'));
    }

    public function create($groupId)
    {
        $condominiumId = $this->groupCondominiumRepository->getCondominiumId($groupId);
        $usersCondominium = $this->usersCondominiumRepository->listUsersCondominiumFind($condominiumId);

        return view('portal.condominium.group.user.create', compact('usersCondominium', 'groupId'));
    }

    public function store(UsersGroupCondominiumRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($groupId, $id)
    {
        $dados = $this->repository->find($id);
        $condominiumId = $this->groupCondominiumRepository->getCondominiumId($groupId);
        $usersCondominium = $this->usersCondominiumRepository->listUsersCondominiumFind($condominiumId);

        return view('portal.condominium.group.user.edit', compact('dados', 'usersCondominium', 'groupId'));
    }

    public function update(UsersGroupCondominiumRequest $request, $groupId, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($groupId, $id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Group deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UsersRole deleted.');
    }
}
