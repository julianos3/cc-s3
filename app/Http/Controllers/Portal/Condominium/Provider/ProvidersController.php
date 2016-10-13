<?php

namespace CentralCondo\Http\Controllers\Portal\Condominium\Provider;

use CentralCondo\Repositories\Portal\Condominium\CondominiumRepository;
use CentralCondo\Repositories\Portal\Condominium\Provider\ProviderCategoryRepository;
use CentralCondo\Repositories\Portal\Condominium\Provider\ProvidersRepository;
use CentralCondo\Services\Portal\Condominium\Provider\ProvidersService;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Condominium\Provider\ProvidersRequest;
use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Services\Util\UtilObjeto;


class ProvidersController extends Controller
{
    /**
     * @var ProvidersRepository
     */
    protected $repository;

    /**
     * @var ProvidersService
     */
    private $service;

    /**
     * @var ProviderCategoryRepository
     */
    private $providerCategoryRepository;

    private $utilObjeto;

    /**
     * ProvidersController constructor.
     * @param ProvidersRepository $repository
     * @param ProvidersService $service
     * @param CondominiumRepository $condominiumRepository
     * @param ProviderCategoryRepository $providerCategoryRepository
     */
    public function __construct(ProvidersRepository $repository,
                                ProvidersService $service,
                                ProviderCategoryRepository $providerCategoryRepository, UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->providerCategoryRepository = $providerCategoryRepository;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = "Fornecedores";
        $dados = $this->repository
            ->with(['providerCategory'])
            ->findWhere([
                'condominium_id' => $this->condominium_id
            ]);

        $dados = $this->utilObjeto->paginate($dados);
        return view('portal.condominium.provider.index', compact('config','dados'));
    }

    public function create()
    {
        $config['title'] = "Novo Fornecedor";
        $providerCategory = $this->providerCategoryRepository->listCondominium($this->condominium_id);

        return view('portal.condominium.provider.create', compact('config', 'providerCategory'));
    }

    public function store(ProvidersRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $config['title'] = "Alterar Fornecedor";
        $dados = $this->repository->findWhere([
            'id' => $id,
            'condominium_id' => $this->condominium_id
        ]);
        $dados = $dados[0];
        $providerCategory = $this->providerCategoryRepository->listCondominium($this->condominium_id);

        return view('portal.condominium.provider.edit', compact('config', 'dados', 'providerCategory'));
    }

    public function update(ProvidersRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
