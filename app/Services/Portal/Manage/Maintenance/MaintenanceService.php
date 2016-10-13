<?php

namespace CentralCondo\Services\Portal\Manage\Maintenance;

use CentralCondo\Repositories\Portal\Manage\Maintenance\MaintenanceRepository;
use CentralCondo\Validators\Portal\Manage\Maintenance\MaintenanceValidator;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class MaintenanceService
{

    /**
     * @var MaintenanceRepository
     */
    protected $repository;

    /**
     * @var MaintenanceValidator
     */
    protected $validator;

    public function __construct(MaintenanceRepository $repository, MaintenanceValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->condominium_id = session()->get('condominium_id');
        $this->user_condominium_id = session()->get('user_condominium_id');
    }

    public function create(array $data)
    {
        try {
            $data['user_condominium_id'] = $this->user_condominium_id;
            $data['condominium_id'] = $this->condominium_id;
            $data['start_date'] = date('Y-m-d H:i:s', strtotime($data['start_date']));
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if($dados) {
                $response = trans("Manutenção Preventiva cadastrado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao cadastrar Manutenção Preventiva");
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
            //return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function update(array $data, $id)
    {
        try {
            $data['condominium_id'] = $this->condominium_id;
            $data['user_condominium_id'] = $this->user_condominium_id;
            $data['start_date'] = date('Y-m-d H:i:s', strtotime($data['start_date']));
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->update($data, $id);

            if($dados) {
                $response = trans("Manutenção Preventiva alterado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao alterar o Recurso Comum");
            //return redirect()->back()->withErrors($response)->withInput();
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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