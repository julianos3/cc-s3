<?php

namespace CentralCondo\Http\Controllers\Portal\Condominium\Group;

use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Services\Portal\Condominium\Group\UsersGroupCondominiumService;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Condominium\Group\UsersGroupCondominiumRequest;
use CentralCondo\Repositories\Portal\Condominium\Group\UsersGroupCondominiumRepository;
use CentralCondo\Services\Util\UtilObjeto;
use CentralCondo\Http\Controllers\Controller;

class UsersGroupCondominiumController extends Controller
{
    /**
     * @var UsersGroupCondominiumRepository
     */
    protected $repository;

    /**
     * @var UsersGroupCondominiumService
     */
    private $service;

    /**
     * @var UsersCondominium
     */
    private $usersCondominiumRepository;

    /**
     * @var UtilObjeto
     */
    private $utilObjeto;

    /**
     * UsersGroupCondominiumController constructor.
     * @param UsersGroupCondominiumRepository $repository
     * @param UsersGroupCondominiumService $service
     * @param UsersCondominiumRepository $usersCondominium
     * @param UtilObjeto $utilObjeto
     */
    public function __construct(UsersGroupCondominiumRepository $repository,
                                UsersGroupCondominiumService $service,
                                UsersCondominiumRepository $usersCondominium,
                                UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->usersCondominiumRepository = $usersCondominium;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index($groupId)
    {
        $config['title'] = "Integrantes do Grupo";
        $dados = $this->repository
            ->with(['usersCondominium'])
            ->findWhere([
                'group_id' => $groupId
            ]);
        $dados = $this->utilObjeto->paginate($dados);
        $usersCondominium = $this->usersCondominiumRepository->listUsersCondominiumFind($this->condominium_id);

        return view('portal.condominium.group.user.index', compact('config', 'dados', 'groupId', 'usersCondominium'));
    }

    public function create($groupId)
    {
        $config['title'] = "Cadastrar integrante no Grupo";
        $usersCondominium = $this->usersCondominiumRepository->listUsersCondominiumFind($this->condominium_id);

        return view('portal.condominium.group.user.create', compact('config', 'usersCondominium', 'groupId'));
    }

    public function store(UsersGroupCondominiumRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
