<?php

namespace CentralCondo\Http\Controllers\Portal\Communication\Communication;

use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests\Portal\Communication\Communication\CommunicationRequest;
use CentralCondo\Repositories\Portal\Communication\Communication\CommunicationRepository;
use CentralCondo\Services\Portal\Communication\Communication\CommunicationService;
use CentralCondo\Repositories\Portal\Condominium\Group\GroupCondominiumRepository;
use CentralCondo\Services\Util\UtilObjeto;


class CommunicationController extends Controller
{
    /**
     * @var CommunicationRepository
     */
    protected $repository;

    /**
     * @var CommunicationService
     */
    private $service;

    /**
     * @var GroupCondominiumRepository
     */
    private $groupCondominiumRepository;

    /**
     * @var UtilObjeto
     */
    private $utilObjeto;

    /**
     * CommunicationController constructor.
     * @param CommunicationRepository $repository
     * @param CommunicationService $service
     * @param GroupCondominiumRepository $groupCondominiumRepository
     * @param UtilObjeto $utilObjeto
     */
    public function __construct(CommunicationRepository $repository,
                                CommunicationService $service,
                                GroupCondominiumRepository $groupCondominiumRepository,
                                UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->groupCondominiumRepository = $groupCondominiumRepository;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = 'Comunicados';
        $dados = $this->repository->findWhere([
            'condominium_id' => $this->condominium_id
        ]);
        $dados = $this->utilObjeto->paginate($dados);

        return view('portal.communication.communication.index', compact('config', 'dados'));
    }

    public function create()
    {
        $config['title'] = 'Novo Comunicado';
        $groupCondominium = $this->groupCondominiumRepository
            ->orderBy('name', 'asc')
            ->findWhere([
                'condominium_id' => $this->condominium_id
            ]);

        return view('portal.communication.communication.create', compact('config', 'groupCondominium'));
    }

    public function store(CommunicationRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $dados = $this->repository->find($id);
        $dados['date_display'] = date('d/m/Y', strtotime($dados['date_display']));
        $condominium = $this->condominiumRepository->listCondominium();
        $groupCondominium = $this->groupCondominiumRepository->listGroupCondominium();

        //$usersCondominium = $this->usersCondominiumRepository->all();

        return view('portal.communication.communication.edit', compact('dados', 'condominium', 'usersCondominium', 'groupCondominium'));
    }

    public function update(CommunicationRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'Communication' => 'UsersRole deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('Communication', 'UsersRole deleted.');
    }
}
