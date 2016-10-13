<?php

namespace CentralCondo\Services\Portal\Communication\Message;

use CentralCondo\Repositories\Portal\Communication\Message\MessageReplyRepository;
use CentralCondo\Validators\Portal\Communication\Message\MessageReplyValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class MessageReplyService
{

    /**
     * @var MessageReplyRepository
     */
    protected $repository;

    /**
     * @var MessageReplyValidator
     */
    protected $validator;

    public function __construct(MessageReplyRepository $repository, MessageReplyValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->condominium_id = session()->get('condominium_id');
        $this->user_condominium_id = session()->get('user_condominium_id');
    }

    public function create(array $data)
    {
        try {
            $data['user_condominium_id'] = $this->user_condominium_id;
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if ($dados) {
                $response = trans("Resposta enviada com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = [
                'error' => true,
                'message' => $e->getMessageBag()
            ];

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $deleted = $this->repository->delete($id);

        if ($deleted) {
            $response = trans("Resposta removida com sucesso!");
            return redirect()->back()->with('status', trans($response));
        } else {
            $response = trans("Erro ao removevr resposta!");
            return redirect()->back()->withErrors($response)->withInput();
        }

    }

}