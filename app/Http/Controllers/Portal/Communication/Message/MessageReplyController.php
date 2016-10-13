<?php

namespace CentralCondo\Http\Controllers\Portal\Communication\Message;

use CentralCondo\Repositories\Portal\CondominiumRepository;
use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Repositories\Portal\Communication\Message\UsersMessageRepository;
use CentralCondo\Services\Portal\Communication\Message\MessageReplyService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Communication\Message\MessageReplyRequest;
use CentralCondo\Repositories\Portal\Communication\Message\MessageReplyRepository;
use CentralCondo\Validators\Portal\Communication\Message\MessageReplyValidator;
use CentralCondo\Http\Controllers\Controller;


class MessageReplyController extends Controller
{
    /**
     * @var MessageReplyRepository
     */
    protected $repository;

    /**
     * @var MessageReplyService
     */
    private $service;

    /**
     * MessageReplyController constructor.
     * @param MessageReplyRepository $repository
     * @param MessageReplyValidator $validator
     * @param MessageReplyService $service
     * @param UsersCondominiumRepository $usersCondominiumRepository
     * @param UsersMessageRepository $usersMessageRepository
     */
    public function __construct(MessageReplyRepository $repository,
                                MessageReplyService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index($messageId)
    {
        $dados = $this->repository->findWhere([
            'message_id' => $messageId
        ]);
        return view('portal.message.reply.index', compact('dados', 'messageId'));
    }

    public function create($messageId)
    {
        $usersCondominium = $this->usersMessageRepository->findWhere([
            'message_id' => $messageId
        ]);

        return view('portal.message.reply.create', compact('usersCondominium', 'messageId'));
    }

    public function store(MessageReplyRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($messageId, $id)
    {
        $dados = $this->repository->find($id);
        $usersCondominium = $this->usersMessageRepository->findWhere([
            'message_id' => $messageId
        ]);

        return view('portal.message.reply.edit', compact('dados', 'usersCondominium', 'messageId'));
    }

    public function update(MessageReplyRequest $request, $messageId, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
    
}
