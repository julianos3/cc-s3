<?php

namespace CentralCondo\Services\Portal\Communication\Message;

use CentralCondo\Repositories\Portal\Communication\Message\UsersMessageRepository;
use CentralCondo\Validators\Portal\Communication\Message\UsersMessageValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class UsersMessageService //regras de negocios
{

    /**
     * @var UsersMessageRepository
     */
    protected $repository;

    /**
     * @var UsersMessageValidator
     */
    protected $validator;

    public function __construct(UsersMessageRepository $repository, UsersMessageValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {

        try {
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if($dados) {
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

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $dados = $this->repository->update($data, $id);

            if($dados) {
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