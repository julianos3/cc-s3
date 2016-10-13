<?php

namespace CentralCondo\Http\Controllers\Portal\Manage\Maintenance;

use CentralCondo\Repositories\Portal\Manage\PeriodicityRepository;
use CentralCondo\Repositories\Portal\Condominium\Provider\ProvidersRepository;
use CentralCondo\Services\Portal\Manage\Maintenance\MaintenanceService;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Manage\Maintenance\MaintenanceRequest;
use CentralCondo\Repositories\Portal\Manage\Maintenance\MaintenanceRepository;
use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Services\Util\UtilObjeto;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class MaintenanceController extends Controller
{
    /**
     * @var MaintenanceRepository
     */
    protected $repository;

    /**
     * @var MaintenanceService
     */
    private $service;

    /**
     * @var PeriodicityRepository
     */
    private $periodicityRepository;

    /**
     * @var ProvidersRepository
     */
    private $providersRepository;

    private $utilObjeto;

    /**
     * MaintenanceController constructor.
     * @param MaintenanceRepository $repository
     * @param MaintenanceService $service
     * @param PeriodicityRepository $periodicityRepository
     * @param ProvidersRepository $providersRepository
     */
    public function __construct(MaintenanceRepository $repository,
                                MaintenanceService $service,
                                PeriodicityRepository $periodicityRepository,
                                ProvidersRepository $providersRepository, UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->periodicityRepository = $periodicityRepository;
        $this->providersRepository = $providersRepository;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = "Manutenções Preventivas";
        $dados = $this->repository->with('periodicity')->findWhere([
            'condominium_id' => $this->condominium_id
        ]);

        $dados = $this->utilObjeto->paginate($dados);
        $providers = $this->providersRepository->listCondominium($this->condominium_id);

        return view('portal.manage.maintenance.index', compact('config', 'dados', 'providers'));
    }

    public function create()
    {
        $config['title'] = "Cadastrar Manutenção Preventiva";
        $periodicity = $this->periodicityRepository->listPeriodicity();

        return view('portal.manage.maintenance.create', compact('config', 'periodicity'));
    }

    public function store(MaintenanceRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $config['title'] = "Alterar Manutenção Preventiva";
        $dados = $this->repository->findWhere([
            'id' => $id,
            'condominium_id' => $this->condominium_id
        ]);
        $dados = $dados[0];
        $dados['start_date'] = date('d/m/Y', strtotime($dados['start_date']));
        $periodicity = $this->periodicityRepository->listPeriodicity();

        return view('portal.manage.maintenance.edit', compact('dados', 'config', 'periodicity'));
    }

    public function update(MaintenanceRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
