<?php

namespace CentralCondo\Services\Portal\Communication\Message;

use CentralCondo\Entities\Portal\Condominium\Group\UsersGroupCondominium;
use CentralCondo\Repositories\Portal\Communication\Message\MessageGroupRepository;
use CentralCondo\Repositories\Portal\Communication\Message\UsersMessageRepository;
use CentralCondo\Repositories\Portal\Condominium\Group\UsersGroupCondominiumRepository;
use CentralCondo\Validators\Portal\Communication\Message\MessageGroupValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class MessageGroupService
{

    protected $repository;

    protected $validator;

    protected $usersGroupCondominumRepository;

    protected $usersMessageRepository;

    protected $usersMessageService;

    protected $messageService;

    public function __construct(MessageGroupRepository $repository,
                                MessageGroupValidator $validator,
                                UsersGroupCondominiumRepository $usersGroupCondominumRepository,
                                UsersMessageRepository $usersMessageRepository,
                                UsersMessageService $usersMessageService,
                                MessageService $messageService)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->usersGroupCondominumRepository = $usersGroupCondominumRepository;
        $this->usersMessageRepository = $usersMessageRepository;
        $this->usersMessageService = $usersMessageService;
        $this->messageService = $messageService;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if($dados) {

                //cadastra users condominium pelo group
                $this->registerUsersMessage($dados);

                $response = [
                    'message' => 'UsersRole add.',
                    'data' => $dados->toArray(),
                ];

                return redirect()->back()->with('message', $response['message']);
            }
        } catch (ValidatorException $e) {
            $response = [
                'error' => true,
                'message' => $e->getMessageBag()
            ];


            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function registerUsersMessage($data)
    {
        if ($data->toArray()) {
            //buscar os usuarios do condominium que pertencem aos grupos cadastrados da mensagem
            $groups = $this->usersGroupCondominumRepository->findWhere(['group_id' => $data['group_id']]);
            //dd($data['group_id']);
            if($groups->toArray()) {
                foreach ($groups as $row) {
                    $message['message_id'] = $data['message_id'];
                    $message['user_condominium_id'] = $row->user_condominium_id;

                    $this->usersMessageService->create($message);
                    //cadastra notificação aos usuarios
                    //$this->registerNotification($communicationId, $row->user_condominium_id);

                }
            }

            return true;
        }

        return false;
    }

}