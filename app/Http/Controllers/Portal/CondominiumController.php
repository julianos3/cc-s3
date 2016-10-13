<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Repositories\Portal\FinalityRepository;
use CentralCondo\Services\Portal\CondominiumService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Repositories\Portal\CondominiumRepository;
use CentralCondo\Validators\Portal\CondominiumValidator;
use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests\Portal\CondominiumRequest;


class CondominiumController extends Controller
{

    /**
     * @var CondominiumRepository
     */
    protected $repository;

    /**
     * @var CondominiumValidator
     */
    protected $validator;

    /**
     * @var CondominiumRepository
     */
    protected $roleRepository;

    /**
     * @var CondominiumService
     */
    protected $service;

    /**
     * @var FinalityRepository
     */
    protected $finalityRepository;

    public function __construct(CondominiumRepository $repository, CondominiumValidator $validator,
                                CondominiumRepository $roleRepository, CondominiumService $service,
                                FinalityRepository $finalityRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->roleRepository = $roleRepository;
        $this->service = $service;
        $this->finalityRepository = $finalityRepository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $dados = $this->repository->all();

        return view('portal.condominium.index', compact('dados'));
    }

    public function create()
    {
        $finality = $this->finalityRepository->listFinality();
        return view('portal.condominium.create', compact('finality'));
    }

    public function store(CondominiumRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id)
    {
        $dados = $this->repository->find($id);
        return view('portal.condominium.show', compact('dados'));
    }

    public function edit($id)
    {
        $dados = $this->repository->find($id);
        $finality = $this->finalityRepository->listFinality();
        return view('portal.condominium.edit', compact('dados', 'finality'));
    }

    public function update(CondominiumRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Condominium deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Condominium deleted.');
    }
}
