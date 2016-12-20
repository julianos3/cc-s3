<?php

namespace CentralCondo\Services\Portal\Manage\Contract;

use CentralCondo\Repositories\Portal\Manage\Contract\ContractFileRepository;
use CentralCondo\Repositories\Portal\Manage\Contract\ContractRepository;
use CentralCondo\Validators\Portal\Manage\Contract\ContractValidator;
use Illuminate\Validation\Validator;
use Prettus\Validator\Exceptions\ValidatorException;

class ContractService
{

    protected $repository;

    protected $validator;

    protected $contractFileService;

    protected $contractFileRepository;

    public function __construct(ContractRepository $repository,
                                ContractValidator $validator,
                                ContractFileService $contractFileService,
                                ContractFileRepository $contractFileRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->contractFileService = $contractFileService;
        $this->contractFileRepository = $contractFileRepository;
        $this->condominium_id = session()->get('condominium_id');
    }
    
    public function create(array $data)
    {
        try {
            $data['condominium_id'] = $this->condominium_id;
            $data['start_date'] = date('Y-m-d H:i:s', strtotime(str_replace('/','-', $data['start_date'])));
            $data['end_date'] = date('Y-m-d H:i:s', strtotime(str_replace('/','-',$data['end_date'])));

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
            $data['start_date'] = date('Y-m-d H:i:s', strtotime(str_replace('/','-', $data['start_date'])));
            $data['end_date'] = date('Y-m-d H:i:s', strtotime(str_replace('/','-',$data['end_date'])));

            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->update($data, $id);

            //add contract file
            if($data['files']){
                $this->contractFileService->createMultiple($dados['id'], $data);
            }

            if ($dados) {
                $response = trans("Contrato alterado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao alterar o Contrato");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function destroy($id)
    {
        //remove files
        $files = $this->contractFileRepository->findWhere(['contract_id' => $id]);
        if($files->toArray()){
            foreach($files as $row){
                $this->contractFileService->destroy($row->id);
            }
        }
        
        $deleted = $this->repository->delete($id);
        if ($deleted) {
            $response = trans("Contrato excluido com sucesso!");
            return redirect()->back()->with('status', trans($response));
        } else {
            $response = trans("Erro ao excluir o Contrato");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

}