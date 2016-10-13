<?php

namespace CentralCondo\Services\Portal\Communication\Called;

use CentralCondo\Repositories\Portal\Communication\Called\CalledRepository;
use CentralCondo\Validators\Portal\Communication\Called\CalledValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class CalledService //regras de negocios
{

    /**
     * @var CalledRepository
     */
    protected $repository;

    /**
     * @var CalledValidator
     */
    protected $validator;

    /**
     * @var CalledHistoricService
     */
    protected $calledHistoricService;

    /**
     * CalledService constructor.
     * @param CalledRepository $repository
     * @param CalledValidator $validator
     * @param CalledHistoricService $calledHistoricService
     */
    public function __construct(CalledRepository $repository,
                                CalledValidator $validator,
                                CalledHistoricService $calledHistoricService)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->calledHistoricService = $calledHistoricService;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if($dados) {

                //historic register
                $historic['called_id'] = $dados['id'];
                $historic['called_status_id'] = $dados['called_status_id'];
                $historic['description'] = $dados['description'];
                $historic['user_condominium_id'] = $dados['user_condominium_id'];

                $this->calledHistoricService->create($historic);

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
            $called = $this->repository->find($id);
            $description = $data['description'];
            $data['description'] = $called['description'];

            //DEVE ALTERAR APENAS O STATUS
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $dados = $this->repository->update($data, $id);

            if($dados) {

                //historic register
                $historic['called_id'] = $dados['id'];
                $historic['called_status_id'] = $dados['called_status_id'];
                $historic['description'] = $description;
                $historic['user_condominium_id'] = $dados['user_condominium_id'];

                $this->calledHistoricService->create($historic);

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