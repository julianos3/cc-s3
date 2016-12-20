<?php

namespace CentralCondo\Http\Controllers\Portal\Condominium\Group;

use CentralCondo\Repositories\Portal\Condominium\CondominiumRepository;
use CentralCondo\Repositories\Portal\Condominium\Group\UsersGroupCondominiumRepository;
use CentralCondo\Services\Portal\Condominium\Group\GroupCondominiumService;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Condominium\Group\GroupCondominiumRequest;
use CentralCondo\Repositories\Portal\Condominium\Group\GroupCondominiumRepository;
use CentralCondo\Services\Util\UtilObjeto;
use CentralCondo\Http\Controllers\Controller;

class GroupCondominiumController extends Controller
{
    /**
     * @var GroupCondominiumRepository
     */
    protected $repository;

    /**
     * @var GroupCondominiumService
     */
    private $service;

    /**
     * @var CondominiumRepository
     */
    private $condominiumRepository;

    /**
     * @var UsersGroupCondominiumRepository
     */
    private $usersGroupCondominiumRepository;

    /**
     * @var UtilObjeto
     *
     */
    private $utilObjeto;

    /**
     * GroupCondominiumController constructor.
     * @param GroupCondominiumRepository $repository
     * @param GroupCondominiumService $service
     * @param CondominiumRepository $condominiumRepository
     * @param UsersGroupCondominiumRepository $usersGroupCondominiumRepository
     * @param UtilObjeto $utilObjeto
     */
    public function __construct(GroupCondominiumRepository $repository,
                                GroupCondominiumService $service,
                                CondominiumRepository $condominiumRepository,
                                UsersGroupCondominiumRepository $usersGroupCondominiumRepository,
                                UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->condominiumRepository = $condominiumRepository;
        $this->usersGroupCondominiumRepository = $usersGroupCondominiumRepository;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = 'Grupos';
        $dados = $this->repository->orderBy('name','asc')->findWhere(['condominium_id' => $this->condominium_id]);
        $dados = $this->utilObjeto->paginate($dados);

        return view('portal.condominium.group.index', compact('config', 'dados'));
    }

    public function create()
    {
        $config['title'] = 'Novo Grupo';
        return view('portal.condominium.group.create', compact('config'));
    }

    public function store(GroupCondominiumRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $config['title'] = 'Editar Grupo';
        $dados = $this->repository->findWhere(['id' =>$id, 'condominium_id' => $this->condominium_id]);
        $dados =  $dados[0];

        return view('portal.condominium.group.edit', compact('config', 'dados'));
    }

    public function update(GroupCondominiumRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
