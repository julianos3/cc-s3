<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Http\Requests;
use CentralCondo\Repositories\Portal\CityRepository;
use CentralCondo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;


class CityController extends Controller
{
    /**
     * @var CityRepository
     */
    protected $repository;

    /**
     * CityController constructor.
     * @param CityRepository $repository
     */
    public function __construct(CityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getCity($state_id)
    {
        $dados = $this->repository->findWhere([
            'state_id' => $state_id
        ]);

        return Response::json($dados);
    }

}
