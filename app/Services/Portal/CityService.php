<?php

namespace CentralCondo\Services\Portal;

use CentralCondo\Repositories\Portal\CityRepository;
use CentralCondo\Validators\Portal\CityValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class CityService //regras de negocios
{

    /**
     * @var CityRepository
     */
    protected $repository;

    /**
     * @var CityValidator
     */
    protected $validator;

    public function __construct(CityRepository $repository, CityValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {

        try {
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