<?php

namespace CentralCondo\Services\Portal\Communication\Communication;

use CentralCondo\Repositories\Portal\Communication\Communication\CommunicationGroupRepository;
use CentralCondo\Repositories\Portal\Communication\Communication\CommunicationRepository;
use CentralCondo\Validators\Portal\Communication\Communication\CommunicationValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class CommunicationService
{

    /**
     * @var CommunicationRepository
     */
    protected $repository;

    /**
     * @var CommunicationValidator
     */
    protected $validator;

    /**
     * @var CommunicationGroupRepository
     */
    protected $communicationGroupRepository;

    /**
     * CommunicationService constructor.
     * @param CommunicationRepository $repository
     * @param CommunicationValidator $validator
     * @param CommunicationGroupRepository $communicationGroupRepository
     */
    public function __construct(CommunicationRepository $repository,
                                CommunicationValidator $validator,
                                CommunicationGroupRepository $communicationGroupRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->communicationGroupRepository = $communicationGroupRepository;
    }

    public function create(array $data)
    {

        try {
            $data['date_display'] = date('Y-m-d', strtotime($data['date_display']));

            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if ($dados) {

                //commnunication group
                if ($data['all_user'] == 'n') {
                    if (count($data['group']) > 0) {
                        foreach ($data['group'] as $row) {

                            $commnucationGroup['communication_id'] = $dados['id'];
                            $commnucationGroup['group_condominium_id'] = $row;

                            $this->communicationGroupRepository->create($commnucationGroup);

                        }
                    }
                }

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
            $data['date_display'] = date('Y-m-d', strtotime($data['date_display']));

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