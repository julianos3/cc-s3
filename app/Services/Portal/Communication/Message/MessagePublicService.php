<?php

namespace CentralCondo\Services\Portal\Communication\Message;

use CentralCondo\Repositories\Portal\Communication\Message\MessageReplyRepository;
use CentralCondo\Repositories\Portal\Communication\Message\MessageRepository;
use CentralCondo\Repositories\Portal\Communication\Message\UsersMessageRepository;
use CentralCondo\Validators\Portal\Communication\Message\MessageValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class MessagePublicService
{

    protected $repository;

    protected $validator;

    protected $usersMessageRepository;

    protected $messageReplyRepository;

    public function __construct(MessageRepository $repository,
                                MessageValidator $validator,
                                UsersMessageRepository $usersMessageRepository,
                                MessageReplyRepository $messageReplyRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->usersMessageRepository = $usersMessageRepository;
        $this->messageReplyRepository = $messageReplyRepository;
        $this->condominium_id = session()->get('condominium_id');
        $this->user_condominium_id = session()->get('user_condominium_id');
    }

    public function create(array $data)
    {

        try {
            $data['public'] = 'y';
            $data['type'] = 's';
            $data['condominium_id'] = $this->condominium_id;
            $data['user_condominium_id'] = $this->user_condominium_id;
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);

            if ($dados) {
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

    public function destroy($id)
    {
        //remover todas as mensagens
        $reply = $this->messageReplyRepository->findWhere(['message_id' => $id]);

        if ($reply->toArray()) {
            foreach ($reply as $row) {
                $this->messageReplyRepository->delete($row->id);
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