<?php

namespace CentralCondo\Http\Controllers\Portal\Manage\Maintenance;

use CentralCondo\Repositories\Portal\Condominium\Provider\ProvidersRepository;
use CentralCondo\Services\Portal\Manage\Maintenance\MaintenanceCompletedService;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Manage\Maintenance\MaintenanceCompletedRequest;
use CentralCondo\Repositories\Portal\Manage\Maintenance\MaintenanceCompletedRepository;
use CentralCondo\Http\Controllers\Controller;

class MaintenanceCompletedController extends Controller
{
    /**
     * @var MaintenanceCompletedRepository
     */
    protected $repository;

    /**
     * @var MaintenanceCompletedService
     */
    private $service;

    /**
     * @var
     */
    private $providersRepository;

    /**
     * MaintenanceCompletedController constructor.
     * @param MaintenanceCompletedRepository $repository
     * @param MaintenanceCompletedService $service
     * @param ProvidersRepository $providersRepository
     */
    public function __construct(MaintenanceCompletedRepository $repository,
                                MaintenanceCompletedService $service,
                                ProvidersRepository $providersRepository)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->providersRepository = $providersRepository;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index($id)
    {
        $config['title'] = "Manutenções Realizadas";
        $dados = $this->repository
            ->with(['provider'])
            ->orderBy('date', 'desc')
            ->findWhere([
                'maintenance_id' => $id
            ]);

        return view('portal.manage.maintenance.completed.index', compact('config', 'dados'));
    }

    public function store(MaintenanceCompletedRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $config['title'] = "Alterar Manutenção Preventiva";
        $dados = $this->repository->findWhere([
            'id' => $id
        ]);
        $dados = $dados[0];
        $dados['date'] = date('d/m/Y', strtotime($dados['date']));
        $providers = $this->providersRepository->listCondominium($this->condominium_id);

        return view('portal.manage.maintenance.completed.edit', compact('dados', 'config', 'providers'));
    }

    public function update(MaintenanceCompletedRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
