<?php

namespace CentralCondo\Services\Portal;

use CentralCondo\Repositories\Portal\LostAndFoundRepository;
use CentralCondo\Validators\Portal\LostAndFoundValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class LostAndFoundService //regras de negocios
{

    /**
     * @var LostAndFoundRepository
     */
    protected $repository;

    /**
     * @var LostAndFoundValidator
     */
    protected $validator;

    /**
     * LostAndFoundService constructor.
     * @param LostAndFoundRepository $repository
     * @param LostAndFoundValidator $validator
     */
    public function __construct(LostAndFoundRepository $repository,
                                LostAndFoundValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
}

    public function create(array $data)
    {

        try {
            $data['date'] = date('Y-m-d H:i:s', strtotime($data['date']));

            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if ($dados) {

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
            $data['date'] = date('Y-m-d', strtotime($data['date']));

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $dados = $this->repository->update($data, $id);

            if ($dados) {
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