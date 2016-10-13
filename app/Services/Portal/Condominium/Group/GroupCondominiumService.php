<?php

namespace CentralCondo\Services\Portal\Condominium\Group;

use CentralCondo\Repositories\Portal\Condominium\Group\GroupCondominiumRepository;
use CentralCondo\Validators\Portal\Condominium\Group\GroupCondominiumValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class GroupCondominiumService //regras de negocios
{

    /**
     * @var GroupCondominiumRepository
     */
    protected $repository;

    /**
     * @var GroupCondominiumValidator
     */
    protected $validator;

    public function __construct(GroupCondominiumRepository $repository, GroupCondominiumValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function create(array $data)
    {
        try {
            $data['condominium_id'] = $this->condominium_id;
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if($dados) {
                $response = trans("Grupo cadastrado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao cadastrar o grupo");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function update(array $data, $id)
    {
        try {
            $data['condominium_id'] = $this->condominium_id;
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->update($data, $id);

            if($dados) {
                $response = trans("Grupo alterado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao alterar o grupo");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function destroy($id)
    {
        //excluir integrantes do grupo
        $deleted = $this->repository->delete($id);
        if ($deleted) {
            $response = trans("Grupo excluido com sucesso!");
            return redirect()->back()->with('status', trans($response));
        } else {
            $response = trans("Erro ao excluir o grupo");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

}