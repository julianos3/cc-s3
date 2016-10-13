<?php

namespace CentralCondo\Http\Controllers\Portal\Communication\Called;

use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Services\Portal\Communication\Called\CalledHistoricService;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\CalledHistoricRequest;
use CentralCondo\Repositories\Portal\Communication\Called\CalledHistoricRepository;
use CentralCondo\Validators\Portal\Communication\Called\CalledHistoricValidator;
use CentralCondo\Http\Controllers\Controller;

class CalledHistoricController extends Controller
{
    /**
     * @var CalledHistoricRepository
     */
    protected $repository;

    /**
     * @var CalledHistoricValidator
     */
    protected $validator;

    /**
     * @var CalledHistoricService
     */
    private $service;

    /**
     * @var UsersCondominium
     */
    private $usersCondominiumRepository;

    /**
     * CalledHistoricController constructor.
     * @param CalledHistoricRepository $repository
     * @param CalledHistoricValidator $validator
     * @param CalledHistoricService $service
     * @param UsersCondominiumRepository $usersCondominium
     * @param DiaryRepository $diaryRepository
     */
    public function __construct(CalledHistoricRepository $repository,
                                CalledHistoricValidator $validator,
                                CalledHistoricService $service,
                                UsersCondominiumRepository $usersCondominium)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->usersCondominiumRepository = $usersCondominium;
        $this->diaryRepository = $diaryRepository;
    }

    public function index($calledId)
    {
        $dados = $this->repository->findWhere([
            'called_id' => $calledId
        ]);
        return view('portal.called.historic.index', compact('dados', 'calledId'));
    }

}
