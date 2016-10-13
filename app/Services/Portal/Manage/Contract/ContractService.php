<?php

namespace CentralCondo\Services\Portal\Manage\Contract;

use CentralCondo\Repositories\Portal\Manage\Contract\ContractRepository;
use CentralCondo\Validators\Portal\Manage\Contract\ContractValidator;
use Illuminate\Validation\Validator;
use Prettus\Validator\Exceptions\ValidatorException;

class ContractService
{

    /**
     * @var ContractRepository
     */
    protected $repository;

    /**
     * @var ContractValidator
     */
    protected $validator;

    /**
     * @var ContractFileService
     */
    protected $contractFileService;

    public function __construct(ContractRepository $repository,
                                ContractValidator $validator,
                                ContractFileService $contractFileService)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->contractFileService = $contractFileService;
        $this->condominium_id = session()->get('condominium_id');
    }

    
    public function create(array $data)
    {
        try {
            $data['condominium_id'] = $this->condominium_id;
            $data['start_date'] = date('Y-m-d H:i:s', strtotime($data['start_date']));
            $data['end_date'] = date('Y-m-d H:i:s', strtotime($data['end_date']));

            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);

            //add contract file
            if($data['files']){
                $this->contractFileService->createMultiple($dados['id'], $data);
            }

            if ($dados) {
                $response = trans("Contrato cadastrado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao cadastrar o Contrato");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function update(array $data, $id)
    {
        try {

            $data['condominium_id'] = $this->condominium_id;
            $data['start_date'] = date('Y-m-d H:i:s', strtotime($data['start_date']));
            $data['end_date'] = date('Y-m-d H:i:s', strtotime($data['end_date']));

            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->update($data, $id);

            //add contract file
            if($data['files']){
                $this->contractFileService->createMultiple($dados['id'], $data);
            }

            if ($dados) {
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