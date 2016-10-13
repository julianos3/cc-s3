<?php

namespace CentralCondo\Http\Controllers\Portal\Communication\Message;

use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Communication\Message\MessageRequest;
use CentralCondo\Repositories\Portal\Communication\Message\MessageRepository;
use CentralCondo\Services\Portal\Communication\Message\MessagePublicService;


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
     * MessagePublicController constructor.
     * @param MessageRepository $repository
     * @param MessagePublicService $service
     */
    public function __construct(MessageRepository $repository,
                                MessagePublicService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = 'Mensagens Públicas';
        $dados = $this->repository->with(['usersCondominium', 'messageReply'])->findWhere(['condominium_id' => $this->condominium_id]);
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
