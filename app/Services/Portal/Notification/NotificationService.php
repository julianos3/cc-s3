<?php

namespace CentralCondo\Services\Portal\Notification;

use CentralCondo\Repositories\Portal\Notification\NotificationRepository;
use CentralCondo\Validators\Portal\Notification\NotificationValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class NotificationService
{

    /**
     * @var NotificationRepository
     */
    protected $repository;

    /**
     * @var NotificationValidator
     */
    protected $validator;

    public function __construct(NotificationRepository $repository, NotificationValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        try {
            $data['view'] = 'n';
            $data['click'] = 'n';

            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if($dados) {
                $response = [
                    'message' => 'Notificação enviado com sucesso!',
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

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        if ($deleted) {
            $response = trans("Notificação removida com sucesso!");
            return redirect()->back()->with('status', trans($response));
        } else {
            $response = trans("Erro ao remover Mensagem!");
            return redirect()->back()->withErrors($response)->withInput();
        }

    }

    public function clickAll($userCondominiumId)
    {
        if($userCondominiumId){

            $dados = $this->repository->scopeQuery(function($query) use ($userCondominiumId){
                return $query->where('user_condominium_id', $userCondominiumId)
                    ->update(['click' => 'y']);
            })->all();

            //ItemTable::where('item_type_id', '=', 1)->update(['color' => 'black']);

            return 'ok';
        }
        return false;
    }

}