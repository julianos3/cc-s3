<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Services\Portal\Condominium\FinalityService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\FinalityRequest;
use CentralCondo\Repositories\Portal\Condominium\FinalityRepository;
use CentralCondo\Validators\Portal\Condominium\FinalityValidator;
use CentralCondo\Http\Controllers\Controller;


class FinalityController extends Controller
{
    /**
     * @var FinalityRepository
     */
    protected $repository;

    /**
     * @var FinalityValidator
     */
    protected $validator;

    /**
     * @var FinalityService
     */
    private $service;

    /**
     * FinalityController constructor.
     * @param FinalityRepository $repository
     * @param FinalityValidator $validator
     * @param FinalityService $service
     */
    public function __construct(FinalityRepository $repository,
                                FinalityValidator $validator,
                                FinalityService $service)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->repository->all();
        return view('portal.condominium.finality.index', compact('data'));
    }

    public function create()
    {
        return view('portal.condominium.finality.create');
    }

    public function store(FinalityRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $data = $this->repository->find($id);

        return view('portal.condominium.finality.edit', compact('data'));
    }

    public function update(FinalityRequest $request, $id)
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
