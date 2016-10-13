<?php

namespace CentralCondo\Http\Controllers\Portal\Condominium\Block;

use CentralCondo\Repositories\Portal\Condominium\CondominiumRepository;
use CentralCondo\Services\Portal\Condominium\Block\BlockService;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Condominium\Block\BlockRequest;
use CentralCondo\Repositories\Portal\Condominium\Block\BlockRepository;
use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Services\Util\UtilObjeto;

class BlockController extends Controller
{
    /**
     * @var BlockRepository
     */
    protected $repository;

    /**
     * @var BlockService
     */
    private $service;

    /**
     * @var CondominiumRepository
     */
    private $condominiumRepository;

    private $utilObjeto;

    /**
     * BlockController constructor.
     * @param BlockRepository $repository
     * @param BlockService $service
     * @param CondominiumRepository $condominiumRepository
     */
    public function __construct(BlockRepository $repository,
                                BlockService $service,
                                CondominiumRepository $condominiumRepository, UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->condominiumRepository = $condominiumRepository;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = "Blocos";
        $dados = $this->repository->findWhere(['condominium_id' => $this->condominium_id]);

        $dados = $this->utilObjeto->paginate($dados);

        return view('portal.condominium.block.index', compact('config', 'dados'));
    }

    public function create()
    {
        $config['title'] = "Novo Bloco";
        return view('portal.condominium.block.create', compact('config'));
    }

    public function store(BlockRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $config['title'] = "Alterar Bloco";
        $dados = $this->repository->find($id);

        return view('portal.condominium.block.edit', compact('config', 'dados'));
    }

    public function update(BlockRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

}
