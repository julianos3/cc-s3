<?php

namespace CentralCondo\Services\Portal;

use CentralCondo\Repositories\Portal\LostAndFoundCompletedRepository;
use CentralCondo\Repositories\Portal\LostAndFoundRepository;
use CentralCondo\Validators\Portal\LostAndFoundCompletedValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class LostAndFoundCompletedService //regras de negocios
{

    /**
     * @var LostAndFoundCompletedRepository
     */
    protected $repository;

    /**
     * @var LostAndFoundCompletedValidator
     */
    protected $validator;

    /**
     * @var LostAndFoundRepository
     */
    protected $lostAndFoundRepository;

    /**
     * LostAndFoundCompletedService constructor.
     * @param LostAndFoundCompletedRepository $repository
     * @param LostAndFoundCompletedValidator $validator
     * @param LostAndFoundRepository $lostAndFoundRepository
     */
    public function __construct(LostAndFoundCompletedRepository $repository,
                                LostAndFoundCompletedValidator $validator,
                                LostAndFoundRepository $lostAndFoundRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->lostAndFoundRepository = $lostAndFoundRepository;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if($dados) {

                $objLostAndFound = $this->lostAndFoundRepository->find($data['lost_and_found_id']);
                $lostAndFound['condominium_id'] = $objLostAndFound->condominium_id;
                $lostAndFound['user_condominium_id'] = $objLostAndFound->user_condominium_id;
                $lostAndFound['name'] = $objLostAndFound->name;
                $lostAndFound['description'] = $objLostAndFound->description;
                $lostAndFound['date'] = $objLostAndFound->date;
                $lostAndFound['found'] = 'y';
                $this->lostAndFoundRepository->update($lostAndFound, $data['lost_and_found_id']);

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