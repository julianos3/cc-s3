<?php

namespace CentralCondo\Http\Controllers\Portal\Communication\Called;

use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Communication\Called\CalledRequest;
use CentralCondo\Repositories\Portal\Communication\Called\CalledCategoryRepository;
use CentralCondo\Repositories\Portal\Communication\Called\CalledRepository;
use CentralCondo\Repositories\Portal\Communication\Called\CalledStatusRepository;
use CentralCondo\Services\Portal\Communication\Called\CalledService;
use CentralCondo\Services\Util\UtilObjeto;

class CalledController extends Controller
{
    /**
     * @var CalledRepository
     */
    protected $repository;

    /**
     * @var CalledService
     */
    private $service;

    /**
     * @var CalledCategoryRepository
     */
    private $calledCategoryRepository;

    /**
     * @var CalledStatusRepository
     */
    private $calledStatusCategory;

    /**
     * @var UtilObjeto
     */
    private $utilObjeto;

    /**
     * CalledController constructor.
     * @param CalledRepository $repository
     * @param CalledService $service
     * @param CalledCategoryRepository $calledCategoryRepository
     * @param CalledStatusRepository $calledStatusRepository
     * @param UtilObjeto $utilObjeto
     */
    public function __construct(CalledRepository $repository,
                                CalledService $service,
                                CalledCategoryRepository $calledCategoryRepository,
                                CalledStatusRepository $calledStatusRepository,
                                UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->calledCategoryRepository = $calledCategoryRepository;
        $this->calledStatusCategory = $calledStatusRepository;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = 'Chamados';
        $dados = $this->repository
            ->orderBy('created_at', 'desc')
            ->with(['usersCondominium', 'calledCategory', 'calledStatus'])
            ->findWhere(['condominium_id' => $this->condominium_id]);
        $dados = $this->utilObjeto->paginate($dados);

        return view('portal.communication.called.index', compact('config', 'dados'));
    }

    public function create()
    {
        $config['title'] = 'Cadastrar Chamado';
        $calledCategory = $this->calledCategoryRepository->listCondominium($this->condominium_id);
        $calledStatus = $this->calledStatusCategory->listAll();

        return view('portal.communication.called.create', compact('config', 'calledCategory', 'calledStatus', 'usersCondominium'));
    }

    public function store(CalledRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $config['title'] = 'Alterar Chamao';
        $dados = $this->repository->with(['calledCategory', 'calledStatus', 'calledHistoric', 'usersCondominium'])->findWhere(['id' => $id, 'condominium_id' => $this->condominium_id]);
        $dados = $dados[0];
        $calledCategory = $this->calledCategoryRepository->listCondominium($this->condominium_id);
        $calledStatus = $this->calledStatusCategory->listAll();

        return view('portal.communication.called.edit', compact('dados', 'config', 'calledCategory', 'calledStatus'));
    }

    public function show($id)
    {
        $dados = $this->repository->with(['calledCategory', 'calledStatus', 'calledHistoric', 'usersCondominium'])->findWhere(['id' => $id, 'condominium_id' => $this->condominium_id]);
        $dados = $dados[0];
        return view('portal.communication.called.show', compact('dados'));
    }

    public function update(CalledRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
