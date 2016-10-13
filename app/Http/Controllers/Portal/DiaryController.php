<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Entities\Portal\ReserveAreas;
use CentralCondo\Repositories\Portal\CondominiumRepository;
use CentralCondo\Repositories\Portal\ReserveAreasRepository;
use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Services\Portal\DiaryService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\DiaryRequest;
use CentralCondo\Repositories\Portal\DiaryRepository;
use CentralCondo\Validators\Portal\DiaryValidator;
use CentralCondo\Http\Controllers\Controller;


class DiaryController extends Controller
{
    /**
     * @var DiaryRepository
     */
    protected $repository;

    /**
     * @var DiaryValidator
     */
    protected $validator;

    /**
     * @var DiaryService
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
     * @var ReserveAreas
     */
    private $reserveAreasRepository;

    /**
     * DiaryController constructor.
     * @param DiaryRepository $repository
     * @param DiaryValidator $validator
     * @param DiaryService $service
     * @param CondominiumRepository $condominiumRepository
     * @param UsersCondominiumRepository $usersCondominiumRepository
     * @param ReserveAreasRepository $reserveAreasRepository
     */
    public function __construct(DiaryRepository $repository,
                                DiaryValidator $validator,
                                DiaryService $service,
                                CondominiumRepository $condominiumRepository,
                                UsersCondominiumRepository $usersCondominiumRepository,
                                ReserveAreasRepository $reserveAreasRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->condominiumRepository = $condominiumRepository;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
        $this->reserveAreasRepository = $reserveAreasRepository;
    }

    public function index()
    {
        $dados = $this->repository->all();
        return view('portal.diary.index', compact('dados'));
    }

    public function create()
    {
        $condominium = $this->condominiumRepository->listCondominium();
        $userCondominium = $this->usersCondominiumRepository->all();
        $reserveAreas = $this->reserveAreasRepository->all();
        return view('portal.diary.create', compact('condominium', 'userCondominium', 'reserveAreas'));
    }

    public function store(DiaryRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $dados = $this->repository->find($id);
        $dados['start_date'] = date('d/m/y H:i:s', strtotime($dados['start_date']));
        $dados['end_date'] = date('d/m/Y H:i:s', strtotime($dados['end_date']));

        $condominium = $this->condominiumRepository->listCondominium();
        $userCondominium = $this->usersCondominiumRepository->all();
        $reserveAreas = $this->reserveAreasRepository->all();

        return view('portal.diary.edit', compact('dados', 'condominium', 'userCondominium', 'reserveAreas'));
    }

    public function update(DiaryRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'UsersRole deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UsersRole deleted.');
    }
}
