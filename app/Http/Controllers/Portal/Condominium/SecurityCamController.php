<?php

namespace CentralCondo\Http\Controllers\Portal\Condominium;

use CentralCondo\Repositories\Portal\Condominium\CondominiumRepository;
use CentralCondo\Services\Portal\Condominium\SecurityCamService;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Condominium\SecurityCamRequest;
use CentralCondo\Repositories\Portal\Condominium\SecurityCamRepository;
use CentralCondo\Services\Util\UtilObjeto;
use CentralCondo\Validators\Portal\Condominium\SecurityCamValidator;
use CentralCondo\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class SecurityCamController extends Controller
{
    /**
     * @var SecurityCamRepository
     */
    protected $repository;

    /**
     * @var SecurityCamValidator
     */
    protected $validator;

    /**
     * @var SecurityCamService
     */
    private $service;

    /**
     * @var CondominiumRepository
     */
    private $condominiumRepository;

    private $utilObjeto;

    /**
     * SecurityCamController constructor.
     * @param SecurityCamRepository $repository
     * @param SecurityCamValidator $validator
     * @param SecurityCamService $service
     * @param CondominiumRepository $condominiumRepository
     */
    public function __construct(SecurityCamRepository $repository,
                                SecurityCamValidator $validator,
                                SecurityCamService $service,
                                CondominiumRepository $condominiumRepository, UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->condominiumRepository = $condominiumRepository;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = "Câmeras de Segurança";
        $dados = $this->repository->findWhere(['condominium_id' => $this->condominium_id]);

        $dados = $this->utilObjeto->paginate($dados);

        return view('portal.condominium.security-cam.index', compact('config', 'dados'));
    }

    public function show($id)
    {
        $dados = $this->repository->findWhere(['id' => $id, 'condominium_id' => $this->condominium_id]);
        $dados = $dados[0];

        return view('portal.condominium.security-cam.show', compact('dados'));
    }

    public function listAll()
    {
        $config['title'] = "Todas as câmeras";
        $dados = $this->repository->findWhere(['condominium_id' => $this->condominium_id]);

        return view('portal.condominium.security-cam.list', compact('config', 'dados'));
    }

    public function create()
    {
        $config['title'] = "Nova Câmera de Segurança";
        return view('portal.condominium.security-cam.create', compact('config'));
    }

    public function store(SecurityCamRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $config['title'] = "Alterar Câmera de Segurança";
        $dados = $this->repository->findWhere(['id' => $id, 'condominium_id' => $this->condominium_id]);
        $dados = $dados[0];

        return view('portal.condominium.security-cam.edit', compact('config', 'dados'));
    }

    public function update(SecurityCamRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
