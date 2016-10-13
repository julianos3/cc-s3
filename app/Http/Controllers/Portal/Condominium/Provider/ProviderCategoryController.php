<?php

namespace CentralCondo\Http\Controllers\Portal\Condominium\Provider;

use CentralCondo\Services\Portal\Condominium\Provider\ProviderCategoryService;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Condominium\Provider\ProviderCategoryRequest;
use CentralCondo\Repositories\Portal\Condominium\Provider\ProviderCategoryRepository;
use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Services\Util\UtilObjeto;

class ProviderCategoryController extends Controller
{
    /**
     * @var ProviderCategoryRepository
     */
    protected $repository;

    /**
     * @var ProviderCategoryService
     */
    private $service;

    private $utilObjeto;

    /**
     * ProviderCategoryController constructor.
     * @param ProviderCategoryRepository $repository
     * @param ProviderCategoryService $service
     */
    public function __construct(ProviderCategoryRepository $repository,
                                ProviderCategoryService $service, UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = "Categorias";
        $dados = $this->repository
            ->orderBy('name', 'asc')
            ->findWhere([
                'condominium_id' => $this->condominium_id
            ]);

        $dados = $this->utilObjeto->paginate($dados);

        return view('portal.condominium.provider.category.index', compact('config','dados'));
    }

    public function create()
    {
        $config['title'] = "Nova Catergoria";
        return view('portal.condominium.provider.category.create', compact('config'));
    }

    public function store(ProviderCategoryRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $config['title'] = "Alterar Categoria";
        $dados = $this->repository->find($id);
        return view('portal.condominium.provider.category.edit', compact('config','dados'));
    }

    public function update(ProviderCategoryRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
