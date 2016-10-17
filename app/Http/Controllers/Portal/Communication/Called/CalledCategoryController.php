<?php

namespace CentralCondo\Http\Controllers\Portal\Communication\Called;

use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests\Portal\Communication\Called\CalledCategoryRequest;
use CentralCondo\Repositories\Portal\Communication\Called\CalledCategoryRepository;
use CentralCondo\Services\Portal\Communication\Called\CalledCategoryService;
use CentralCondo\Services\Util\UtilObjeto;

class CalledCategoryController extends Controller
{
    /**
     * @var CalledCategoryRepository
     */
    protected $repository;

    /**
     * @var CalledCategoryService
     */
    private $service;

    /**
     * @var UtilObjeto
     */
    private $utilObjeto;

    /**
     * CalledCategoryController constructor.
     * @param CalledCategoryRepository $repository
     * @param CalledCategoryService $service
     * @param UtilObjeto $utilObjeto
     */
    public function __construct(CalledCategoryRepository $repository,
                                CalledCategoryService $service, UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = 'Categoria Chamado';
        $dados = $this->repository->findWhere(['condominium_id' => $this->condominium_id]);
        $dados = $this->utilObjeto->paginate($dados);

        return view('portal.communication.called.category.index', compact('config', 'dados'));
    }

    public function create()
    {
        $config['title'] = 'Cadastrar Categoria';
        return view('portal.communication.called.category.create', compact('config'));
    }

    public function store(CalledCategoryRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $config['title'] = 'Alterar Categoria';
        $dados = $this->repository->findWhere(['id' => $id, 'condominium_id' => $this->condominium_id]);
        $dados = $dados['0'];
        
        return view('portal.communication.called.category.edit', compact('dados', 'config'));
    }

    public function update(CalledCategoryRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
