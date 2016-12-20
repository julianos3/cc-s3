<?php

namespace CentralCondo\Services\Portal\Manage\Maintenance;

use CentralCondo\Repositories\Portal\Manage\Maintenance\MaintenanceCompletedRepository;
use CentralCondo\Validators\Portal\Manage\Maintenance\MaintenanceCompletedValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class MaintenanceCompletedService
{
    
    protected $repository;

    protected $validator;

    public function __construct(MaintenanceCompletedRepository $repository,
                                MaintenanceCompletedValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->condominium_id = session()->get('condominium_id');
        $this->user_condominium_id = session()->get('user_condominium_id');
    }

    public function create(array $data)
    {
        try {
            $data['condominium_id'] = $this->condominium_id;
            $data['date'] = date('Y-m-d', strtotime(str_replace('/','-',$data['date'])));
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if($dados) {
                $response = trans("Registro de Manutenção cadastrado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao registrar Manutenção");
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
            //return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function update(array $data, $id)
    {
        try {
            $maintenanceId = $this->repository->find($id);
            $data['maintenance_id'] = $maintenanceId['maintenance_id'];
            $data['date'] = date('Y-m-d', strtotime(str_replace('/','-',$data['date'])));
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->update($data, $id);

            if($dados) {
                $response = trans("Registro de Manutenção alterado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao alterar o Registro de Manutenção");
            //return redirect()->back()->withErrors($response)->withInput();
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        if ($deleted) {
            $response = trans("Registro de Manutenção excluido com sucesso!");
            return redirect()->back()->with('status', trans($response));
        } else {
            $response = trans("Erro ao excluir o Registro de Manutenção");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

}