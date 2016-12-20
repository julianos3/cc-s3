<?php

namespace CentralCondo\Http\Controllers\Portal\Communication\Message;

use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Communication\Message\MessageRequest;
use CentralCondo\Repositories\Portal\Communication\Message\MessageRepository;
use CentralCondo\Repositories\Portal\Communication\Message\UsersMessageRepository;
use CentralCondo\Repositories\Portal\Condominium\Group\GroupCondominiumRepository;
use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Services\Portal\Communication\Message\MessagePrivateService;
use CentralCondo\Services\Util\UtilObjeto;

class MessagePrivateController extends Controller
{
    /**
     * @var MessageRepository
     */
    protected $repository;

    /**
     * @var MessagePrivateService
     */
    private $service;

    /**
     * @var UtilObjeto
     */
    private $utilObjeto;

    /**
     * @var GroupCondominiumRepository
     */
    private $groupCondominiumRepository;

    /**
     * @var UsersCondominiumRepository
     */
    private $usersCondominiumRepository;

    private $usersMessageRepository;

    /**
     * MessagePrivateController constructor.
     * @param MessageRepository $repository
     * @param MessagePrivateService $service
     * @param UtilObjeto $utilObjeto
     * @param GroupCondominiumRepository $groupCondominiumRepository
     * @param UsersCondominiumRepository $usersCondominiumRepository
     */
    public function __construct(MessageRepository $repository,
                                MessagePrivateService $service,
                                UtilObjeto $utilObjeto,
                                GroupCondominiumRepository $groupCondominiumRepository,
                                UsersCondominiumRepository $usersCondominiumRepository,
                                UsersMessageRepository $usersMessageRepository)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->utilObjeto = $utilObjeto;
        $this->groupCondominiumRepository = $groupCondominiumRepository;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
        $this->usersMessageRepository = $usersMessageRepository;
        $this->user_condominium_id = session()->get('user_condominium_id');
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = 'Mensagens Privadas';
        $dados = $this->usersMessageRepository
            ->orderBy('created_at', 'desc')
            ->with(['message'])
            ->findWhere(['user_condominium_id' => $this->user_condominium_id]);
        //dd($dados);
        /*
        $dados = $this->repository
            ->orderBy('created_at', 'desc')
            ->with(['usersCondominium', 'messageReply', 'group'])
            ->findWhere([
                'condominium_id' => $this->condominium_id,
                'public' => 'n'
            ]);
        */
        $dados = $this->utilObjeto->paginate($dados);

        return view('portal.communication.message.private.index', compact('config', 'dados'));
    }

    public function create()
    {
        $config['title'] = 'Nova Mensagem Privada';
        $groupCondominium = $this->groupCondominiumRepository->findWhere(['condominium_id' => $this->condominium_id]);
        $usersCondominium = $this->usersCondominiumRepository
            ->with(['user'])
            ->findWhere(['condominium_id' => $this->condominium_id]);
        return view('portal.communication.message.private.create', compact('config', 'groupCondominium', 'usersCondominium'));
    }

    public function store(MessageRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

}
