<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Entities\Portal\UsersCondominium;
use CentralCondo\Repositories\Portal\DiaryRepository;
use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Services\Portal\CalledHistoricService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\CalledHistoricRequest;
use CentralCondo\Repositories\Portal\CalledHistoricRepository;
use CentralCondo\Validators\Portal\CalledHistoricValidator;
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
     * @var DiaryRepository
     */
    private $diaryRepository;

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
                                UsersCondominiumRepository $usersCondominium,
                                DiaryRepository $diaryRepository)
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
