<?php

namespace CentralCondo\Http\Controllers\Portal\Communication\Message;

use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Communication\Message\MessageRequest;
use CentralCondo\Repositories\Portal\Communication\Message\MessageRepository;
use CentralCondo\Services\Portal\Communication\Message\MessagePublicService;
use CentralCondo\Services\Util\UtilObjeto;

class MessagePublicController extends Controller
{
    /**
     * @var MessageRepository
     */
    protected $repository;

    /**
     * @var MessagePublicService
     */
    private $service;

    /**
     * @var UtilObjeto
     */
    private $utilObjeto;

    /**
     * MessagePublicController constructor.
     * @param MessageRepository $repository
     * @param MessagePublicService $service
     * @param UtilObjeto $utilObjeto
     */
    public function __construct(MessageRepository $repository,
                                MessagePublicService $service,
                                UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = 'Mensagens Públicas';
        $dados = $this->repository
            ->orderBy('created_at', 'desc')
            ->with(['usersCondominium', 'messageReply'])
            ->findWhere(['condominium_id' => $this->condominium_id, 'public' => 'y']);
        $dados = $this->utilObjeto->paginate($dados);

        return view('portal.communication.message.public.index', compact('config', 'dados'));
    }

    public function create()
    {
        $config['title'] = 'Nova Mensagem Pública';
        return view('portal.communication.message.public.create', compact('config'));
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
