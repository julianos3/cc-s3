<?php

namespace CentralCondo\Services\Portal\Communication\Communication;

use CentralCondo\Repositories\Portal\Communication\Communication\UsersCommunicationRepository;
use CentralCondo\Validators\Portal\Communication\Communication\UsersCommunicationValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class UsersCommunicationService
{

    /**
     * @var UsersCommunicationRepository
     */
    protected $repository;

    /**
     * @var UsersCommunicationValidator
     */
    protected $validator;

    /**
     * UsersCommunicationService constructor.
     * @param UsersCommunicationRepository $repository
     * @param UsersCommunicationValidator $validator
     */
    public function __construct(UsersCommunicationRepository $repository,
                                UsersCommunicationValidator $validator)
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
                    'message' => 'Comunicado ao usuário enviado com sucesso!',
                    'data' => $dados->toArray(),
                ];

                return redirect()->back()->with('status', $response['message']);
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