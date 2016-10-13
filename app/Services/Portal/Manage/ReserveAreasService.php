<?php

namespace CentralCondo\Services\Portal\Manage;

use CentralCondo\Repositories\Portal\Manage\ReserveAreasRepository;
use CentralCondo\Validators\Portal\Manage\ReserveAreasValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class ReserveAreasService
{

    /**
     * @var ReserveAreasRepository
     */
    protected $repository;

    /**
     * @var ReserveAreasValidator
     */
    protected $validator;

    public function __construct(ReserveAreasRepository $repository, ReserveAreasValidator $validator)
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
                $response = trans("Recurso Comum cadastrado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao cadastrar o Recurso Comum");
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
                $response = trans("Recurso Comum alterado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao alterar o Recurso Comum");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        if ($deleted) {
            $response = trans("Rescurso Comum excluido com sucesso!");
            return redirect()->back()->with('status', trans($response));
        } else {
            $response = trans("Erro ao excluir o Rescurso Comum");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

}