<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Repositories\Portal\CondominiumRepository;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Repositories\Portal\StateRepository;
use CentralCondo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;


class StateController extends Controller
{
    /**
     * @var StateRepository
     */
    protected $repository;

    /**
     * StateController constructor.
     * @param StateRepository $repository
     */
    public function __construct(StateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getUfId($uf)
    {
        $dados = $this->repository->findWhere([
            'uf' => $uf
        ]);

        return Response::json($dados);
    }

}
