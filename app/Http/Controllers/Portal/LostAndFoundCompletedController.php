<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Repositories\Portal\CondominiumRepository;
use CentralCondo\Repositories\Portal\GroupCondominiumRepository;
use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Services\Portal\LostAndFoundCompletedService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\LostAndFoundCompletedRequest;
use CentralCondo\Repositories\Portal\LostAndFoundCompletedRepository;
use CentralCondo\Http\Controllers\Controller;


class LostAndFoundCompletedController extends Controller
{
    /**
     * @var LostAndFoundCompletedRepository
     */
    protected $repository;

    /**
     * @var LostAndFoundCompletedService
     */
    private $service;

    /**
     * @var CondominiumRepository
     */
    private $condominiumRepository;

    /**
     * @var UsersCondominiumRepository
     */
    private $usersCondominiumRepository;

    /**
     * @var GroupCondominiumRepository
     */
    private $groupCondominiumRepository;

    /**
     * LostAndFoundCompletedController constructor.
     * @param LostAndFoundCompletedRepository $repository
     * @param LostAndFoundCompletedService $service
     * @param CondominiumRepository $condominiumRepository
     * @param UsersCondominiumRepository $usersCondominiumRepository
     * @param GroupCondominiumRepository $groupCondominiumRepository
     */
    public function __construct(LostAndFoundCompletedRepository $repository,
                                LostAndFoundCompletedService $service,
                                CondominiumRepository $condominiumRepository,
                                UsersCondominiumRepository $usersCondominiumRepository, GroupCondominiumRepository $groupCondominiumRepository)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->condominiumRepository = $condominiumRepository;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
        $this->groupCondominiumRepository = $groupCondominiumRepository;
    }

    public function create($lostAndFoundId)
    {
        $usersCondominium = $this->usersCondominiumRepository->all();
        return view('portal.lost-and-found.completed', compact('lostAndFoundId', 'usersCondominium'));
    }

    public function store(LostAndFoundCompletedRequest $request)
    {
        return $this->service->create($request->all());
    }

}
