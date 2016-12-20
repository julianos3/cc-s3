<?php

namespace CentralCondo\Http\Controllers\Portal\Comunication\Message;

use CentralCondo\Services\Portal\Communication\Message\UsersMessageService;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Communication\Message\UsersMessageRequest;
use CentralCondo\Repositories\Portal\Communication\Message\UsersMessageRepository;
use CentralCondo\Validators\Portal\Communication\Message\UsersMessageValidator;
use CentralCondo\Http\Controllers\Controller;


class UsersMessageController extends Controller
{
    /**
     * @var UsersMessageRepository
     */
    protected $repository;

    /**
     * @var UsersMessageValidator
     */
    protected $validator;

    /**
     * @var UsersMessageService
     */
    private $service;

    /**
     * UsersMessageController constructor.
     * @param UsersMessageRepository $repository
     * @param UsersMessageValidator $validator
     * @param UsersMessageService $service
     */
    public function __construct(UsersMessageRepository $repository,
                                UsersMessageValidator $validator,
                                UsersMessageService $service)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
    }

    public function index($messageId)
    {
        $dados = $this->repository->findWhere([
            'message_id' => $messageId
        ]);
        return view('portal.message.users.index', compact('dados', 'messageId'));
    }
    /*

    public function store(UsersMessageRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function update(UsersMessageRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'UsersRole deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UsersRole deleted.');
    }
    */
}
