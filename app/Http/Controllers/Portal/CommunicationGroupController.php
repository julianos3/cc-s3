<?php

namespace CentralCondo\Http\Controllers\Portal;

use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Repositories\Portal\CommunicationGroupRepository;
use CentralCondo\Http\Controllers\Controller;


class CommunicationGroupController extends Controller
{
    /**
     * @var CommunicationGroupRepository
     */
    protected $repository;

    /**
     * CommunicationGroupController constructor.
     * @param CommunicationGroupRepository $repository
     */
    public function __construct(CommunicationGroupRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($communicationId)
    {
        $dados = $this->repository->findWhere([
            'communication_id' => $communicationId
        ]);
        return view('portal.communication.group.index', compact('dados', 'communicationId'));
    }

}
