<?php

namespace CentralCondo\Http\Controllers\Portal\Notification;

use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Notification\NotificationRequest;
use CentralCondo\Repositories\Portal\Notification\NotificationRepository;
use CentralCondo\Services\Portal\Notification\NotificationService;
use CentralCondo\Services\Util\UtilObjeto;

class NotificationController extends Controller
{

    /**
     * @var NotificationRepository
     */
    protected $repository;

    /**
     * @var NotificationService
     */
    private $service;

    /**
     * @var UtilObjeto
     */
    private $utilObjeto;

    /**
     * NotificationController constructor.
     * @param NotificationRepository $repository
     * @param NotificationService $service
     * @param UtilObjeto $utilObjeto
     */
    public function __construct(NotificationRepository $repository,
                                NotificationService $service,
                                UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->utilObjeto = $utilObjeto;
        $this->user_condominium_id = session()->get('user_condominium_id');
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = "Notificações";
        $dados = $this->repository
            ->orderBy('created_at','desc')
            ->with(['usersCondominium'])
            ->findWhere([
                'condominium_id' => $this->condominium_id,
                'user_condominium_id' => $this->user_condominium_id
            ]);

        $dados = $this->utilObjeto->paginate($dados);

        //return view('portal.notification.index', compact('config', 'dados'));
    }

    public function show()
    {
        /*
        $posts = $this->repository->scopeQuery(function($query){
            return $query->orderBy('sort_order','asc');
        })->all();
        */

        $notification = $this->repository
            ->orderBy('created_at','desc')
            ->with(['usersCondominium'])
            ->findWhere([
                'condominium_id' => $this->condominium_id,
                'user_condominium_id' => $this->user_condominium_id,
                'view' => 'n'
            ]);

        //return view('portal.notification.show', compact('notification'));
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
