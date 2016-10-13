<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Repositories\Portal\CondominiumRepository;
use CentralCondo\Repositories\Portal\UnitRepository;
use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Services\Portal\UsersUnitService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\UsersUnitRequest;
use CentralCondo\Repositories\Portal\UsersUnitRepository;
use CentralCondo\Validators\Portal\UsersUnitValidator;
use CentralCondo\Http\Controllers\Controller;


class UsersUnitController extends Controller
{
    /**
     * @var UsersUnitRepository
     */
    protected $repository;

    /**
     * @var UsersUnitValidator
     */
    protected $validator;

    /**
     * @var UsersUnitService
     */
    private $service;

    /**
     * @var UnitRepository
     */
    private $unitRepository;

    /**
     * @var UsersCondominiumRepository
     */
    private $usersCondominiumRepository;

    /**
     * UsersUnitController constructor.
     * @param UsersUnitRepository $repository
     * @param UsersUnitValidator $validator
     * @param UsersUnitService $service
     * @param UnitRepository $unitRepository
     * @param UsersCondominiumRepository $usersCondominiumRepository
     */
    public function __construct(UsersUnitRepository $repository,
                                UsersUnitValidator $validator,
                                UsersUnitService $service,
                                UnitRepository $unitRepository,
                                UsersCondominiumRepository $usersCondominiumRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->unitRepository = $unitRepository;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
    }

    public function index()
    {
        $dados = $this->repository->all();
        return view('portal.unit.user.index', compact('dados'));
    }

    public function create()
    {
        $unit = $this->unitRepository->listUnit();
        $userCondominium = $this->usersCondominiumRepository->all();
        return view('portal.unit.user.create', compact('unit', 'userCondominium'));
    }

    public function store(UsersUnitRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $dados = $this->repository->find($id);
        $unit = $this->unitRepository->listUnit();
        $userCondominium = $this->usersCondominiumRepository->all();

        return view('portal.unit.user.edit', compact('dados', 'unit', 'userCondominium'));
    }

    public function update(UsersUnitRequest $request, $id)
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
