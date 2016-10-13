<?php

namespace CentralCondo\Services\Portal\Condominium\Unit;

use CentralCondo\Repositories\Portal\Condominium\Unit\UsersUnitRepository;
use CentralCondo\Validators\Portal\Condominium\Unit\UsersUnitValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UsersUnitService //regras de negocios
{

    /**
     * @var UsersUnitRepository
     */
    protected $repository;

    /**
     * @var UsersUnitValidator
     */
    protected $validator;

    public function __construct(UsersUnitRepository $repository,
                                UsersUnitValidator $validator)
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
            if ($dados) {
                $response = trans('Unidade vinculada ao integrate cadastrada com sucesso!');
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans('Erro ao cadastrar unidade vinculada ao integrante');
            return redirect()->back()->withErrors($response)->withInput();
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
            $response = trans('Unidade relacionada ao integrante foi removido com sucesso!');
            return redirect()->back()->with('status', trans($response));
        } else {
            $response = trans('Erro ao remover a unidade vinculada ao integrante.');
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

}