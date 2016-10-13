<?php

namespace CentralCondo\Services\Portal;

use CentralCondo\Repositories\Portal\DiaryRepository;
use CentralCondo\Validators\Portal\DiaryValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Carbon\Carbon;

class DiaryService //regras de negocios
{

    /**
     * @var DiaryRepository
     */
    protected $repository;

    /**
     * @var DiaryValidator
     */
    protected $validator;

    /**
     * @var Carbon
     */
    protected $carbon;

    /**
     * DiaryService constructor.
     * @param DiaryRepository $repository
     * @param DiaryValidator $validator
     * @param Carbon $carbon
     */
    public function __construct(DiaryRepository $repository, DiaryValidator $validator, Carbon $carbon)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->carbon = $carbon;
    }

    public function create(array $data)
    {
        //date('d/m/Y H:i:s', strtotime($data));
        //FAZER VALIDAÇÕES DE HORÁRIOS IGUAIS....
        try {

            $data['start_date'] = date('Y-m-d H:i:s', strtotime($data['start_date']));
            $data['end_date'] = date('Y-m-d H:i:s', strtotime($data['end_date']));

            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if($dados) {
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

            $data['start_date'] = date('Y-m-d H:i:s', strtotime($data['start_date']));
            $data['end_date'] = date('Y-m-d H:i:s', strtotime($data['end_date']));

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $dados = $this->repository->update($data, $id);

            if($dados) {
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