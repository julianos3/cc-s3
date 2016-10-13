<?php

namespace CentralCondo\Services\Portal\Communication\Message;

use CentralCondo\Repositories\Portal\Communication\Message\MessageRepository;
use CentralCondo\Repositories\Portal\Communication\Message\UsersMessageRepository;
use CentralCondo\Validators\Portal\Communication\Message\MessageValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class MessageService //regras de negocios
{

    /**
     * @var MessageRepository
     */
    protected $repository;

    /**
     * @var MessageValidator
     */
    protected $validator;

    protected $usersMessageRepository;

    public function __construct(MessageRepository $repository,
                                MessageValidator $validator,
                                UsersMessageRepository $usersMessageRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->usersMessageRepository = $usersMessageRepository;
    }

    public function create(array $data)
    {

        try {
            //dd($data);
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if ($dados) {

                if(is_array($data['users'])){
                    $this->addUsersMessage($dados['id'], $data['users']);
                }
                //cadastra grupo
                /*
                foreach($data['grupos'] as $row){
                    $usersMessage['user_condominium_id'] = $row;
                    $usersMessage['message_id'] = $data['id'];

                    $this->messageGroupRepository->create($usersMessage);
                }


                //cadsatra users_message
                foreach($data['users'] as $row){
                    $usersMessage['user_condominium_id'] = $row;
                    $usersMessage['message_id'] = $data['id'];

                    $this->usersMessageRepository->create($usersMessage);
                }
                */
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

                return redirect()->back()->with('message', $response['message']);
            }
        } catch (ValidatorException $e) {

            $response = response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

}