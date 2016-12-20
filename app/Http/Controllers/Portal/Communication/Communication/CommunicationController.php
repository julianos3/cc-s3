<?php

namespace CentralCondo\Http\Controllers\Portal\Communication\Communication;

use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests\Portal\Communication\Communication\CommunicationRequest;
use CentralCondo\Repositories\Portal\Communication\Communication\CommunicationGroupRepository;
use CentralCondo\Repositories\Portal\Communication\Communication\CommunicationRepository;
use CentralCondo\Repositories\Portal\Communication\Communication\UsersCommunicationRepository;
use CentralCondo\Repositories\Portal\Condominium\Group\GroupCondominiumRepository;
use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Services\Portal\Communication\Communication\CommunicationService;
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
     * @var CommunicationGroupRepository
     */
    private $communicationGroupRepository;

    /**
     * @var UsersCommunicationRepository
     */
    private $usersCommunicationRepository;

    /**
     * @var UtilObjeto
     */
    private $utilObjeto;

    private $usersCondominiumRepository;

    /**
     * CommunicationController constructor.
     * @param CommunicationRepository $repository
     * @param CommunicationService $service
     * @param GroupCondominiumRepository $groupCondominiumRepository
     * @param CommunicationGroupRepository $communicationGroupRepository
     * @param UsersCommunicationRepository $usersCommunicationRepository
     * @param UtilObjeto $utilObjeto
     */
    public function __construct(CommunicationRepository $repository,
                                CommunicationService $service,
                                GroupCondominiumRepository $groupCondominiumRepository,
                                CommunicationGroupRepository $communicationGroupRepository,
                                UsersCommunicationRepository $usersCommunicationRepository,
                                UsersCondominiumRepository $usersCondominiumRepository,
                                UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->groupCondominiumRepository = $groupCondominiumRepository;
        $this->communicationGroupRepository = $communicationGroupRepository;
        $this->usersCommunicationRepository = $usersCommunicationRepository;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
        $this->utilObjeto = $utilObjeto;
        $this->user_role_condominium = session()->get('user_role_condominium');
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = 'Comunicados';

        if($this->usersCondominiumRepository->verificaAdm($this->user_role_condominium)){
            $dados = $this->repository->orderBy('created_at', 'desc')
                ->with(['usersCondominium'])
                ->findWhere([
                    'condominium_id' => $this->condominium_id,
                    ['date_display', '>=', date('yyyy/mm/dd')]
                ]);
            $userAdm = 'y';
        }else{
            $dados = $this->repository->orderBy('created_at', 'desc')
                ->with(['usersCondominium'])
                ->findWhere([
                    'condominium_id' => $this->condominium_id,
                    'all_user' => 'y',
                    ['date_display', '>=', date('yyyy/mm/dd')]
                ]);
            $userAdm = 'n';
        }
        $user_role_condominium = $this->user_role_condominium;
        $dados = $this->utilObjeto->paginate($dados);

        return view('portal.communication.communication.index', compact('config', 'dados', 'userAdm', 'user_role_condominium'));
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
        $config['title'] = 'Alterar Comunicado';
        $dados = $this->repository->findWhere(['condominium_id' => $this->condominium_id, 'id' => $id]);
        $dados = $dados[0];
        $dados['date_display'] = date('d/m/Y', strtotime($dados['date_display']));
        $groupCommunication = $this->communicationGroupRepository
            ->with(['groupCondominium'])
            ->findWhere(['communication_id' => $dados['id']]);

        return view('portal.communication.communication.edit', compact('config', 'dados', 'groupCommunication'));
    }

    public function update(CommunicationRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

    public function show($id)
    {
        $config['title'] = 'Visualizar Chamado';
        $dados = $this->repository
            ->with(['communicationGroup', 'usersCommunication'])
            ->findWhere(['id' => $id, 'condominium_id' => $this->condominium_id]);
        $dados = $dados[0];

        $communicationGroup = $this->communicationGroupRepository
            ->with(['groupCondominium'])
            ->findWhere(['communication_id' => $id]);

        $usersCommunication = $this->usersCommunicationRepository
            ->with(['usersCondominium'])
            ->findWhere(['communication_id' => $id]);

        return view('portal.communication.communication.show', compact('config', 'dados', 'communicationGroup', 'usersCommunication'));
    }
}
