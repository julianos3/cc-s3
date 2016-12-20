<?php

namespace CentralCondo\Http\Controllers\Portal\Communication\Message;

use CentralCondo\Services\Portal\Communication\Message\MessageService;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Communication\Message\MessageRequest;
use CentralCondo\Repositories\Portal\Communication\Message\MessageRepository;
use CentralCondo\Validators\Portal\Communication\Message\MessageValidator;
use CentralCondo\Http\Controllers\Controller;


class MessageController extends Controller
{
    /**
     * @var MessageRepository
     */
    protected $repository;

    /**
     * @var MessageService
     */
    private $service;

    /**
     * MessageController constructor.
     * @param MessageRepository $repository
     * @param MessageValidator $validator
     * @param MessageService $service
     */
    public function __construct(MessageRepository $repository,
                                MessageService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        $dados = $this->repository->all();
        return view('portal.communication.message.public.index', compact('dados'));
    }

    public function create()
    {
        $condominium = $this->condominiumRepository->listCondominium();
        $usersCondominium = $this->usersCondominiumRepository->all();

        return view('portal.message.create', compact('condominium', 'usersCondominium'));
    }

    public function store(MessageRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $dados = $this->repository->find($id);
        $condominium = $this->condominiumRepository->listCondominium();
        $usersCondominium = $this->usersCondominiumRepository->all();

        return view('portal.message.edit', compact('dados', 'condominium', 'usersCondominium'));
    }

    public function update(MessageRequest $request, $id)
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
}
