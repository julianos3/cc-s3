<?php

namespace CentralCondo\Services\Portal;

use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Validators\Portal\UsersCondominiumValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class UsersCondominiumService //regras de negocios
{

    /**
     * @var UsersCondominiumRepository
     */
    protected $repository;

    /**
     * @var UsersCondominiumValidator
     */
    protected $validator;

    public function __construct(UsersCondominiumRepository $repository, UsersCondominiumValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {

        $verifica = $this->repository->findWhere([
            //Default Condition =
            'user_id' => $data['user_id'],
            'condominium_id' => $data['condominium_id'],
            ['id','>','0']
        ]);

        if(count($verifica) > 0){
            return redirect()->back()->withErrors("Usuário já cadastrado neste condominio")->withInput();
        }else {

            try {
                $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
                $dados = $this->repository->create($data);

                if ($dados) {
                    $response = [
                        'message' => 'User add.',
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
    }

    public function update(array $data, $id)
    {
        $verifica = $this->repository->findWhere([
            //Default Condition =
            'user_id' => $data['user_id'],
            'condominium_id' => $data['condominium_id'],
            ['id','>','0']
        ]);

        if(count($verifica) > 0){
            return redirect()->back()->withErrors("Usuário já cadastrado neste condominio")->withInput();
        }else {
            try {
                $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
                $dados = $this->repository->update($data, $id);

                if ($dados) {
                    $response = [
                        'message' => 'User updated.',
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

}