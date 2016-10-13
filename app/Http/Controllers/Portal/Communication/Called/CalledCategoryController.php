<?php

namespace CentralCondo\Http\Controllers\Portal\Communication\Called;

use CentralCondo\Repositories\Portal\Condominium\CondominiumRepository;
use CentralCondo\Services\Portal\Communication\Called\CalledCategoryService;
use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\CalledCategoryRequest;
use CentralCondo\Repositories\Portal\Communication\Called\CalledCategoryRepository;
use CentralCondo\Validators\Portal\Communication\Called\CalledCategoryValidator;
use CentralCondo\Http\Controllers\Controller;


class CalledCategoryController extends Controller
{
    /**
     * @var CalledCategoryRepository
     */
    protected $repository;

    /**
     * @var CalledCategoryValidator
     */
    protected $validator;

    /**
     * @var CalledCategoryService
     */
    private $service;

    /**
     * @var CondominiumRepository
     */
    private $condominiumRepository;

    /**
     * CalledCategoryController constructor.
     * @param CalledCategoryRepository $repository
     * @param CalledCategoryValidator $validator
     * @param CalledCategoryService $service
     * @param CondominiumRepository $condominiumRepository
     */
    public function __construct(CalledCategoryRepository $repository,
                                CalledCategoryValidator $validator,
                                CalledCategoryService $service,
                                CondominiumRepository $condominiumRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->condominiumRepository = $condominiumRepository;
    }

    public function index()
    {
        $dados = $this->repository->all();
        return view('portal.called.category.index', compact('dados'));
    }

    public function create()
    {
        $condominium = $this->condominiumRepository->listCondominium();
        return view('portal.called.category.create', compact('condominium'));
    }

    public function store(CalledCategoryRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $dados = $this->repository->find($id);
        $condominium = $this->condominiumRepository->listCondominium();

        return view('portal.called.category.edit', compact('dados', 'condominium'));
    }

    public function update(CalledCategoryRequest $request, $id)
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
