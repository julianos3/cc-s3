<?php

namespace CentralCondo\Services\Portal\Communication\Message;

use CentralCondo\Repositories\Portal\Communication\Message\MessageGroupRepository;
use CentralCondo\Repositories\Portal\Communication\Message\MessageReplyRepository;
use CentralCondo\Repositories\Portal\Communication\Message\MessageRepository;
use CentralCondo\Repositories\Portal\Communication\Message\UsersMessageRepository;
use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Validators\Portal\Communication\Message\MessageValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class MessagePrivateService
{

    protected $repository;

    protected $validator;

    protected $usersMessageRepository;

    protected $messageReplyRepository;

    protected $usersCondominiumRepository;

    protected $usersMessageService;

    protected $messageGroupService;

    protected $messageGroupRepository;

    public function __construct(MessageRepository $repository,
                                MessageValidator $validator,
                                UsersMessageRepository $usersMessageRepository,
                                MessageReplyRepository $messageReplyRepository,
                                UsersCondominiumRepository $usersCondominiumRepository,
                                UsersMessageService $usersMessageService,
                                MessageGroupService $messageGroupService,
                                MessageGroupRepository $messageGroupRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->usersMessageRepository = $usersMessageRepository;
        $this->messageReplyRepository = $messageReplyRepository;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
        $this->usersMessageService = $usersMessageService;
        $this->messageGroupService = $messageGroupService;
        $this->messageGroupRepository = $messageGroupRepository;
        $this->condominium_id = session()->get('condominium_id');
        $this->user_condominium_id = session()->get('user_condominium_id');
    }

    public function create(array $data)
    {
        //dd($data);
        try {
            $data['public'] = 'n';
            $data['type'] = 's'; //send or reply
            $data['condominium_id'] = $this->condominium_id;
            $data['user_condominium_id'] = $this->user_condominium_id;

            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);

            if ($dados) {

                //register users message
                if ($data['destination'] == 'all_user') {
                    $this->registerUser($dados);
                } elseif ($data['destination'] == 'users') {
                    $this->usersMessage($dados['id'], $data['users']);
                } elseif ($data['destination'] == 'group') {
                    $this->messageGroup($dados['id'], $data['groups']);
                }

                $response = trans("Mensagem enviada com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = [
                'error' => true,
                'message' => $e->getMessageBag()
            ];

            //$response = trans("Erro ao cadastrar o Recurso Comum");
            //return redirect()->back()->withErrors($response)->withInput();
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function registerUser($data)
    {
        if ($data->toArray()) {

            $users = $this->usersCondominiumRepository->findWhere(['condominium_id' => $this->user_condominium_id]);
            if ($users->toArray()) {

                foreach ($users as $row) {
                    $message['message_id'] = $data['id'];
                    $message['user_condominium_id'] = $row->id;

                    $this->usersMessageService->create($message);

                    //cadastra notificação aos usuarios
                    //$this->registerNotification($communicationId, $row->user_condominium_id);
                }

            }

            return true;
        }

        return false;
    }

    public function usersMessage($messageId, $users)
    {
        if ($users) {
            foreach ($users as $row) {
                $usersMessage['message_id'] = $messageId;
                $usersMessage['user_condominium_id'] = $row;

                $this->usersMessageService->create($usersMessage);
            }
            return true;
        }

        return false;
    }

    public function messageGroup($messageId, $group)
    {
        if ($group) {
            foreach ($group as $key) {

                $messageGroup['message_id'] = $messageId;
                $messageGroup['group_id'] = $key;

                $this->messageGroupService->create($messageGroup);

            }
            return true;
        }
        return false;
    }


    /*
    public function addUsersMessage($messageId, $users)
    {
        if (is_array($users)) {
            foreach ($users as $row) {
                $usersMessage['user_condominium_id'] = $row;
                $usersMessage['message_id'] = $messageId;

                $this->usersMessageRepository->create($usersMessage);
            }

            return true;
        }

        return false;
    }

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $dados = $this->repository->update($data, $id);

            if ($dados) {
                $response = [
                    'message' => 'UsersRole updated.',
                    'data' => $dados->toArray(),
                ];

                return redirect()->back()->with('status', $response['message']);
            }
        } catch (ValidatorException $e) {

            $response = response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
*/
    public function destroy($id)
    {
        //remover todas as mensagens
        $reply = $this->messageReplyRepository->findWhere(['message_id' => $id]);
        if ($reply->toArray()) {
            foreach ($reply as $row) {
                $this->messageReplyRepository->delete($row->id);
            }
        }

        $usersMessage = $this->usersMessageRepository->findWhere(['message_id' => $id]);
        if ($usersMessage->toArray()) {
            foreach ($usersMessage as $row) {
                $this->usersMessageRepository->delete($row->id);
            }
        }

        $messageGroup = $this->messageGroupRepository->findWhere(['message_id' => $id]);
        if ($messageGroup->toArray()) {
            foreach ($messageGroup as $row) {
                $this->messageGroupRepository->delete($row->id);
            }
        }

        $deleted = $this->repository->delete($id);
        if ($deleted) {
            $response = trans("Mensagem removida com sucesso!");
            return redirect()->back()->with('status', trans($response));
        } else {
            $response = trans("Erro ao remover Mensagem!");
            return redirect()->back()->withErrors($response)->withInput();
        }

    }


}