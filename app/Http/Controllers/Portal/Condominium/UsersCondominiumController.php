<?php

namespace CentralCondo\Http\Controllers\Portal\Condominium;

use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Condominium\UsersCondominiumRequest;
use CentralCondo\Repositories\Portal\Condominium\Block\BlockRepository;
use CentralCondo\Repositories\Portal\Condominium\CondominiumRepository;
use CentralCondo\Repositories\Portal\Condominium\Unit\UsersUnitRepository;
use CentralCondo\Repositories\Portal\Condominium\Unit\UsersUnitRoleRepository;
use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Repositories\Portal\Condominium\UsersRoleCondominiumRepository;
use CentralCondo\Repositories\Portal\UserRepository;
use CentralCondo\Services\Portal\Condominium\UsersCondominiumService;
use CentralCondo\Services\Portal\UserService;
use CentralCondo\Services\Util\UtilObjeto;

class UsersCondominiumController extends Controller
{

    /**
     * @var UsersCondominiumRepository
     */
    protected $repository;

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
     * @var UsersUnitRoleRepository
     */
    protected $usersUnitRoleRepository;

    /**
     * @var BlockRepository
     */
    protected $blockRepository;

    /**
     * @var UsersUnitRepository
     */
    protected $usersUnitRepository;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var UtilObjeto
     */
    protected $utilObjeto;

    /**
     * UsersCondominiumController constructor.
     * @param UsersCondominiumRepository $repository
     * @param UsersCondominiumService $service
     * @param UsersRoleCondominiumRepository $usersRoleCondominiumRepository
     * @param UserRepository $userRepository
     * @param CondominiumRepository $condominiumRepository
     * @param UsersUnitRoleRepository $usersUnitRoleRepository
     * @param BlockRepository $blockRepository
     * @param UsersUnitRepository $usersUnitRepository
     * @param UserService $userService
     */
    public function __construct(UsersCondominiumRepository $repository,
                                UsersCondominiumService $service,
                                UsersRoleCondominiumRepository $usersRoleCondominiumRepository,
                                UserRepository $userRepository,
                                CondominiumRepository $condominiumRepository,
                                UsersUnitRoleRepository $usersUnitRoleRepository,
                                BlockRepository $blockRepository,
                                UsersUnitRepository $usersUnitRepository,
                                UserService $userService, UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->userRoleCondominiumRepository = $usersRoleCondominiumRepository;
        $this->userRepository = $userRepository;
        $this->condominiumRepository = $condominiumRepository;
        $this->usersUnitRoleRepository = $usersUnitRoleRepository;
        $this->blockRepository = $blockRepository;
        $this->usersUnitRepository = $usersUnitRepository;
        $this->userService = $userService;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = trans('Integrantes');

        $dados  = $this->repository
            ->with(['user', 'usersUnit', 'userRoleCondominium'])
            ->findWhere(['condominium_id' => $this->condominium_id]);
        $dados = $this->utilObjeto->paginate($dados);

        return view('portal.condominium.user.index', compact('config', 'dados'));
    }

    public function create()
    {
        $config['title'] = "Novo integrante";
        $role = $this->userRoleCondominiumRepository->orderBy('name','asc')->findWhere(['active' => 'y']);
        $userRole = $this->usersUnitRoleRepository->findWhere(['active' => 'y']);
        $block = $this->blockRepository->findWhere([
            'condominium_id' => $this->condominium_id
        ]);

        return view('portal.condominium.user.create', compact('config', 'block', 'role', 'userRole'));
    }

    public function store(UsersCondominiumRequest $request)
    {
        return $this->service->createUserCondominium($request->all());
    }

    public function show($id)
    {
        $config['title'] = "Perfil Integrante";
        $dados  = $this->repository
            ->with(['user', 'usersUnit', 'userRoleCondominium'])
            ->findWhere([
                'id' => $id,
                'condominium_id' => $this->condominium_id
            ]);
        $dados = $dados[0];

        return view('portal.condominium.user.show', compact('config', 'dados'));
    }

    public function edit($id)
    {
        $config['title'] = "Alterar Integrante";
        $dados = $this->repository
            ->with(['user'])
            ->findWhere([
                'id' => $id,
                'condominium_id' => $this->condominium_id
            ]);

        $userRoleCondominium = $dados[0]['user_role_condominium'];
        $dados = $dados[0]['user'];
        if($dados['birth'] == '0000-00-00'){
            $dados['birth'] = '';
        }else{
            $dados['birth'] = date('d/m/Y', strtotime($dados['birth']));
        }

        $role = $this->userRoleCondominiumRepository->orderBy('name','asc')->findWhere(['active' => 'y']);

        return view('portal.condominium.user.edit', compact('config', 'dados', 'id', 'role', 'userRoleCondominium'));
    }

    public function update(UsersCondominiumRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function unit($id)
    {
        $config['title'] = "Unidades Integrantes";

        $dados = $this->repository
            ->with(['usersUnit', 'user'])
            ->findWhere([
                'id' => $id,
                'condominium_id' => $this->condominium_id
            ]);
        $dados = $dados[0];

        $block = $this->blockRepository->findWhere(['condominium_id' => $this->condominium_id]);
        $userRole = $this->usersUnitRoleRepository->findWhere(['active' => 'y']);
        $userCondominiumId = $dados->id;

        return view('portal.condominium.user.unit', compact('config', 'dados', 'block', 'userRole', 'userCondominiumId'));
    }

    public function userUnitCreate(UsersCondominiumRequest $request)
    {
        return $this->service->userUnitCreate($request->all());
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

}
