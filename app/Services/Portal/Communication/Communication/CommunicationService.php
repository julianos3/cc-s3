<?php

namespace CentralCondo\Services\Portal\Communication\Communication;

use CentralCondo\Repositories\Portal\Communication\Communication\CommunicationGroupRepository;
use CentralCondo\Repositories\Portal\Communication\Communication\CommunicationRepository;
use CentralCondo\Repositories\Portal\Communication\Communication\UsersCommunicationRepository;
use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Repositories\Portal\UsersGroupCondominiumRepository;
use CentralCondo\Validators\Portal\Communication\Communication\CommunicationValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

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
     * @var UsersCondominiumRepository
     */
    protected $usersCondominiumRepository;

    /**
     * @var UsersCommunicationService
     */
    protected $usersCommunicationService;

    protected $usersCommunicationRepository;

    /**
     * CommunicationService constructor.
     * @param CommunicationRepository $repository
     * @param CommunicationValidator $validator
     * @param CommunicationGroupRepository $communicationGroupRepository
     * @param UsersCondominiumRepository $usersCondominiumRepository
     * @param UsersCommunicationService $usersCommunicationService
     */
    public function __construct(CommunicationRepository $repository,
                                CommunicationValidator $validator,
                                CommunicationGroupRepository $communicationGroupRepository,
                                UsersCondominiumRepository $usersCondominiumRepository,
                                UsersCommunicationService $usersCommunicationService, UsersCommunicationRepository $usersCommunicationRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->communicationGroupRepository = $communicationGroupRepository;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
        $this->usersCommunicationService = $usersCommunicationService;
        $this->usersCommunicationRepository = $usersCommunicationRepository;
        $this->user_condominium_id = session()->get('user_condominium_id');
        $this->condominium_id = session()->get('condominium_id');
    }

    public function create(array $data)
    {

        //dd($groups[0]->groupCondominium->usersGroupCondominium());
        try {
            $data['condominium_id'] = $this->condominium_id;
            $data['user_condominium_id'] = $this->user_condominium_id;
            $data['date_display'] = date('Y-m-d', strtotime(str_replace('/','-',$data['date_display'])));
            if ($data['destination'] == 'all_user') {
                $data['all_user'] = 'y';
            } else {
                $data['all_user'] = 'n';
            }
            
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if ($dados) {

                //cadastra notificação aos usuarios

                //cadastra usuarios do comunicado
                if ($dados['all_user'] == 'y') {
                    $this->registerUser($dados['id']);
                } else {
                    //cadastra communication group
                    if ($data['destination'] == 'group') {
                        foreach ($data['groups'] as $row) {

                            $commnucationGroup['communication_id'] = $dados['id'];
                            $commnucationGroup['group_condominium_id'] = $row;
                            $this->communicationGroupRepository->create($commnucationGroup);

                        }
                    }

                    ////cadastra usuario do comunicado referente aos seus grupos
                    $this->registerUserGroups($dados['id']);

                }

                //envia email para os usuarios
                if ($dados['send_mail'] == 'y') {
                    $this->sendMail($dados['id']);
                    //metodo para enviar email para todos os usuários relacionados ao chamado
                    //informando que existser um novo chamado para ele
                    //if(all_user == y) -> envia email para todos os usuarios do condominio
                }

                $response = [
                    'message' => 'Comunicado enviado com sucesso!',
                    'data' => $dados->toArray(),
                ];

                return redirect()->back()->with('status', $response['message']);
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

    public function registerUser($communicationId)
    {
        if ($communicationId) {

            $users = $this->usersCondominiumRepository->findWhere(['condominium_id' => $this->user_condominium_id]);
            if ($users[0]->toArray()) {
                foreach ($users as $row) {
                    $usersCommunication['communication_id'] = $communicationId;
                    $usersCommunication['user_condominium_id'] = $row->id;
                    $usersCommunication['view'] = 'n';

                    $this->usersCommunicationService->create($usersCommunication);
                }
            }

            return true;
        }

        return false;
    }

    public function registerUserGroups($communicationId)
    {
        if ($communicationId) {
            //buscar os usuarios do condominium que pertencem aos grupos cadastrados do comunicado
            $groups = $this->communicationGroupRepository->findWhere(['communication_id' => $communicationId]);

            foreach($groups[0]->groupCondominium->usersGroupCondominium as $row){

                //verifica se já foi adicionado em user_communication
                $verifica = $this->usersCommunicationRepository->findWhere([
                    'communication_id' => $communicationId,
                    'user_condominium_id' => $row->user_condominium_id
                ]);

                if(!$verifica->toArray()){

                    $usersCommunication['user_condominium_id'] = $row->user_condominium_id;
                    $usersCommunication['communication_id'] = $communicationId;
                    $usersCommunication['view'] = 'n';

                    $this->usersCommunicationService->create($usersCommunication);
                }

            }

            return true;
        }

        return false;
    }

    public function sendMail()
    {

    }

}