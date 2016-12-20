<?php

namespace CentralCondo\Http\Controllers\Portal\Manage\Contract;

use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Manage\Contract\ContractRequest;
use CentralCondo\Repositories\Portal\Condominium\Provider\ProvidersRepository;
use CentralCondo\Repositories\Portal\Manage\Contract\ContractFileRepository;
use CentralCondo\Repositories\Portal\Manage\Contract\ContractRepository;
use CentralCondo\Repositories\Portal\Manage\Contract\ContractStatusRepository;
use CentralCondo\Services\Portal\Manage\Contract\ContractService;
use CentralCondo\Services\Util\UtilObjeto;

class ContractController extends Controller
{
    /**
     * @var ContractRepository
     */
    protected $repository;

    /**
     * @var ContractService
     */
    private $service;

    /**
     * @var ContractStatusRepository
     */
    private $contractStatusRepository;

    /**
     * @var ProvidersRepository
     */
    private $providersRepository;

    /**
     * @var ContractFileRepository
     */
    private $contractFileRepository;

    /**
     * @var UtilObjeto
     */
    private $utilObjeto;

    /**
     * ContractController constructor.
     * @param ContractRepository $repository
     * @param ContractService $service
     * @param ContractStatusRepository $contractStatusRepository
     * @param ProvidersRepository $providersRepository
     * @param ContractFileRepository $contractFileRepository
     * @param UtilObjeto $utilObjeto
     */
    public function __construct(ContractRepository $repository,
                                ContractService $service,
                                ContractStatusRepository $contractStatusRepository,
                                ProvidersRepository $providersRepository,
                                ContractFileRepository $contractFileRepository,
                                UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->contractStatusRepository = $contractStatusRepository;
        $this->providersRepository = $providersRepository;
        $this->contractFileRepository = $contractFileRepository;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = "Contratos";
        $dados = $this->repository
            ->orderBy('end_date','asc')
            ->with(['contractStatus', 'providers'])
            ->findWhere([
                'condominium_id' => $this->condominium_id
            ]);

        $dados = $this->utilObjeto->paginate($dados);

        return view('portal.manage.contract.index', compact('config', 'dados'));
    }

    public function create()
    {
        $config['title'] = "Cadastrar Contrato";
        $status = $this->contractStatusRepository->listContractStatus();
        $provider = $this->providersRepository->listCondominium($this->condominium_id);

        return view('portal.manage.contract.create', compact('config', 'status', 'provider'));
    }

    public function store(ContractRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $config['title'] = "Alterar Cotrato";

        $dados = $this->repository->findWhere([
            'id' => $id,
            'condominium_id' => $this->condominium_id
        ]);
        $dados = $dados[0];
        $dados['start_date'] = date('d/m/Y', strtotime($dados['start_date']));
        $dados['end_date'] = date('d/m/Y', strtotime($dados['end_date']));
        $status = $this->contractStatusRepository->listContractStatus();
        $provider = $this->providersRepository->listCondominium($this->condominium_id);
        $files = $this->contractFileRepository->findWhere(['contract_id' => $dados['id']]);

        return view('portal.manage.contract.edit', compact('config', 'dados', 'status', 'provider', 'files'));
    }

    public function update(ContractRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
