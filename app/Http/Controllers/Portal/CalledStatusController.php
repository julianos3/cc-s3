<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Repositories\Portal\CondominiumRepository;
use CentralCondo\Services\Portal\CalledStatusService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\CalledStatusRequest;
use CentralCondo\Repositories\Portal\CalledStatusRepository;
use CentralCondo\Validators\Portal\CalledStatusValidator;
use CentralCondo\Http\Controllers\Controller;


class CalledStatusController extends Controller
{
    /**
     * @var CalledStatusRepository
     */
    protected $repository;

    /**
     * @var CalledStatusValidator
     */
    protected $validator;

    /**
     * @var CalledStatusService
     */
    private $service;

    /**
     * @var CondominiumRepository
     */
    private $condominiumRepository;

    /**
     * CalledStatusController constructor.
     * @param CalledStatusRepository $repository
     * @param CalledStatusValidator $validator
     * @param CalledStatusService $service
     * @param CondominiumRepository $condominiumRepository
     */
    public function __construct(CalledStatusRepository $repository,
                                CalledStatusValidator $validator,
                                CalledStatusService $service,
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
        return view('portal.called.status.index', compact('dados'));
    }

    public function create()
    {
        $condominium = $this->condominiumRepository->listCondominium();
        return view('portal.called.status.create', compact('condominium'));
    }

    public function store(CalledStatusRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $dados = $this->repository->find($id);
        $condominium = $this->condominiumRepository->listCondominium();

        return view('portal.called.status.edit', compact('dados', 'condominium'));
    }

    public function update(CalledStatusRequest $request, $id)
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
