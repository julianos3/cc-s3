<?php

namespace CentralCondo\Services\Portal\Condominium\Unit;

use CentralCondo\Repositories\Portal\Condominium\Unit\UsersUnitRoleRepository;
use CentralCondo\Validators\Portal\Condominium\Unit\UsersUnitRoleValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class UsersUnitRoleService //regras de negocios
{

    /**
     * @var UsersUnitRoleRepository
     */
    protected $repository;

    /**
     * @var UsersUnitRoleValidator
     */
    protected $validator;

    public function __construct(UsersUnitRoleRepository $repository, UsersUnitRoleValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        //verificar se usuario ja esta vinculado a esta unidade

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