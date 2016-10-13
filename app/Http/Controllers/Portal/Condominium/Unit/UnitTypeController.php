<?php

namespace CentralCondo\Http\Controllers\Portal\Condominium\Unit;

use CentralCondo\Services\Portal\Condominium\Unit\UnitTypeService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Condominium\Unit\UnitTypeRequest;
use CentralCondo\Repositories\Portal\Condominium\Unit\UnitTypeRepository;
use CentralCondo\Validators\Portal\Condominium\Unit\UnitTypeValidator;
use CentralCondo\Http\Controllers\Controller;


class UnitTypeController extends Controller
{
    /**
     * @var UnitTypeRepository
     */
    protected $repository;

    /**
     * @var UnitTypeValidator
     */
    protected $validator;

    /**
     * @var UnitTypeService
     */
    private $service;

    /**
     * UnitTypeController constructor.
     * @param UnitTypeRepository $repository
     * @param UnitTypeValidator $validator
     * @param UnitTypeService $service
     */
    public function __construct(UnitTypeRepository $repository, UnitTypeValidator $validator, UnitTypeService $service)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->repository->all();
        return view('portal.unit.type.index', compact('data'));
    }

    public function create()
    {
        return view('portal.unit.type.create');
    }

    public function store(UnitTypeRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $data = $this->repository->find($id);

        return view('portal.unit.type.edit', compact('data'));
    }

    public function update(UnitTypeRequest $request, $id)
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
