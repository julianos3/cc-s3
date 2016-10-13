<?php

namespace CentralCondo\Http\Controllers\Portal\Manage;

use CentralCondo\Services\Portal\Manage\ReserveAreasService;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Manage\ReserveAreasRequest;
use CentralCondo\Repositories\Portal\Manage\ReserveAreasRepository;
use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Services\Util\UtilObjeto;

class ReserveAreasController extends Controller
{
    /**
     * @var ReserveAreasRepository
     */
    protected $repository;

    /**
     * @var ReserveAreasService
     */
    private $service;

    /**
     * @var UtilObjeto
     */
    private $utilObjeto;

    /**
     * ReserveAreasController constructor.
     * @param ReserveAreasRepository $repository
     * @param ReserveAreasService $service
     * @param UtilObjeto $utilObjeto
     */
    public function __construct(ReserveAreasRepository $repository,
                                ReserveAreasService $service,
                                UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = "Recursos Comuns";
        $dados = $this->repository->findWhere([
            'condominium_id' => $this->condominium_id
        ]);
        $dados = $this->utilObjeto->paginate($dados);

        return view('portal.manage.reserve-areas.index', compact('config', 'dados'));
    }

    public function create()
    {
        $config['title'] = "Cadastrar Recurso Comum";

        return view('portal.manage.reserve-areas.create', compact('config'));
    }

    public function store(ReserveAreasRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $config['title'] = "Alterar Recurso Comum";
        $dados = $this->repository->findWhere([
            'id' => $id,
            'condominium_id' => $this->condominium_id
        ]);
        $dados = $dados[0];

        return view('portal.manage.reserve-areas.edit', compact('dados', 'config'));
    }

    public function update(ReserveAreasRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
