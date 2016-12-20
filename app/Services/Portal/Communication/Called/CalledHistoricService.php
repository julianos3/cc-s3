<?php

namespace CentralCondo\Services\Portal\Communication\Called;

use CentralCondo\Repositories\Portal\Communication\Called\CalledHistoricRepository;
use CentralCondo\Services\Portal\Notification\NotificationService;
use CentralCondo\Validators\Portal\Communication\Called\CalledHistoricValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class CalledHistoricService
{

    protected $repository;

    protected $validator;

    protected $notificationService;

    public function __construct(CalledHistoricRepository $repository,
                                CalledHistoricValidator $validator,
                                NotificationService $notificationService)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->notificationService = $notificationService;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if ($dados) {
                return true;
            }
        } catch (ValidatorException $e) {
            return false;
        }
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        if ($deleted) {
            $response = trans("Histórico removido com sucesso!");
            return redirect()->back()->with('status', trans($response));
        } else {
            $response = trans("Erro ao remover Histórico!");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }


}