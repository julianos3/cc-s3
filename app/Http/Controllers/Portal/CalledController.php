<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Entities\Portal\CalledCategory;
use CentralCondo\Repositories\Portal\CalledCategoryRepository;
use CentralCondo\Repositories\Portal\CalledStatusRepository;
use CentralCondo\Repositories\Portal\CondominiumRepository;
use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Services\Portal\CalledService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\CalledRequest;
use CentralCondo\Repositories\Portal\CalledRepository;
use CentralCondo\Validators\Portal\CalledValidator;
use CentralCondo\Http\Controllers\Controller;


class CalledController extends Controller
{
    /**
     * @var CalledRepository
     */
    protected $repository;

    /**
     * @var CalledValidator
     */
    protected $validator;

    /**
     * @var CalledService
     */
    private $service;

    /**
     * @var CondominiumRepository
     */
    private $condominiumRepository;

    /**
     * @var CalledCategoryRepository
     */
    private $calledCategoryRepository;

    /**
     * @var CalledStatusRepository
     */
    private $calledStatusCategory;

    /**
     * @var UsersCondominiumRepository
     */
    private $usersCondominiumRepository;

    /**
     * CalledController constructor.
     * @param CalledRepository $repository
     * @param CalledValidator $validator
     * @param CalledService $service
     * @param CondominiumRepository $condominiumRepository
     * @param CalledCategoryRepository $calledCategoryRepository
     * @param CalledStatusRepository $calledStatusRepository
     * @param UsersCondominiumRepository $usersCondominiumRepository
     */
    public function __construct(CalledRepository $repository,
                                CalledValidator $validator,
                                CalledService $service,
                                CondominiumRepository $condominiumRepository,
                                CalledCategoryRepository $calledCategoryRepository,
                                CalledStatusRepository $calledStatusRepository,
                                UsersCondominiumRepository $usersCondominiumRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->condominiumRepository = $condominiumRepository;
        $this->calledCategoryRepository = $calledCategoryRepository;
        $this->calledStatusCategory = $calledStatusRepository;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
    }

    public function index()
    {
        $dados = $this->repository->all();
        return view('portal.called.index', compact('dados'));
    }

    public function create()
    {
        $condominium = $this->condominiumRepository->listCondominium();
        $calledCategory = $this->calledCategoryRepository->listCalledCategory();
        $calledStatus = $this->calledStatusCategory->listCalledStatus();
        $usersCondominium = $this->usersCondominiumRepository->all();

        return view('portal.called.create', compact('condominium', 'calledCategory', 'calledStatus', 'usersCondominium'));
    }

    public function store(CalledRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $dados = $this->repository->find($id);

        $condominium = $this->condominiumRepository->listCondominium();
        $calledCategory = $this->calledCategoryRepository->listCalledCategory();
        $calledStatus = $this->calledStatusCategory->listCalledStatus();
        $usersCondominium = $this->usersCondominiumRepository->all();

        return view('portal.called.edit', compact('dados', 'condominium', 'calledCategory', 'calledStatus', 'usersCondominium'));
    }

    public function update(CalledRequest $request, $id)
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
