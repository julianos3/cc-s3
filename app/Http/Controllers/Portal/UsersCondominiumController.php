<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Repositories\Portal\CondominiumRepository;
use CentralCondo\Repositories\Portal\UserRepository;
use CentralCondo\Repositories\Portal\UsersRoleCondominiumRepository;
use CentralCondo\Services\Portal\UsersCondominiumService;
use CentralCondo\Services\Portal\UsersRoleCondominiumService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests\Portal\UsersCondominiumRequest;
use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Validators\Portal\UsersCondominiumValidator;


class UsersCondominiumController extends Controller
{

    /**
     * @var UsersCondominiumRepository
     */
    protected $repository;

    /**
     * @var UsersCondominiumValidator
     */
    protected $validator;

    /**
     * @var UsersCondominiumService
     */
    protected $service;

    /**
     * @var UsersRoleCondominiumRepository
     */
    protected $userRoleCondominiumRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var CondominiumRepository
     */
    protected $condominiumRepository;

    /**
     * UsersCondominiumController constructor.
     * @param UsersCondominiumRepository $repository
     * @param UsersCondominiumValidator $validator
     * @param UsersCondominiumService $service
     * @param UsersRoleCondominiumRepository $usersRoleCondominiumRepository
     * @param UserRepository $userRepository
     * @param CondominiumRepository $condominiumRepository
     */
    public function __construct(UsersCondominiumRepository $repository,
                                UsersCondominiumValidator $validator,
                                UsersCondominiumService $service,
                                UsersRoleCondominiumRepository $usersRoleCondominiumRepository,
                                UserRepository $userRepository,
                                CondominiumRepository $condominiumRepository)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
        $this->userRoleCondominiumRepository = $usersRoleCondominiumRepository;
        $this->userRepository = $userRepository;
        $this->condominiumRepository = $condominiumRepository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $dados = $this->repository->all();

        return view('portal.condominium.user.index', compact('dados'));
    }

    public function create()
    {
        $role = $this->userRoleCondominiumRepository->listRole();
        $user = $this->userRepository->listUser();
        $condominium = $this->condominiumRepository->listCondominium();
        return view('portal.condominium.user.create', compact('role', 'user', 'condominium'));
    }

    public function store(UsersCondominiumRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id)
    {
        $dados = $this->repository->find($id);
        return view('portal.condominium.user.show', compact('dados'));
    }

    public function edit($id)
    {
        $dados = $this->repository->find($id);
        $role = $this->userRoleCondominiumRepository->listRole();
        $user = $this->userRepository->listUser();
        $condominium = $this->condominiumRepository->listCondominium();
        return view('portal.condominium.user.edit', compact('dados', 'role', 'user', 'condominium'));
    }

    public function update(UsersCondominiumRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'UsersCondominium deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UsersCondominium deleted.');
    }

}
