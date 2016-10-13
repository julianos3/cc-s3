<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Repositories\Portal\CondominiumRepository;
use CentralCondo\Repositories\Portal\GroupCondominiumRepository;
use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Services\Portal\CommunicationService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\CommunicationRequest;
use CentralCondo\Repositories\Portal\CommunicationRepository;
use CentralCondo\Validators\Portal\CommunicationValidator;
use CentralCondo\Http\Controllers\Controller;


class CommunicationController extends Controller
{
    /**
     * @var CommunicationRepository
     */
    protected $repository;

    /**
     * @var CommunicationValidator
     */
    protected $validator;

    /**
     * @var CommunicationService
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
     * @var GroupCondominiumRepository
     */
    private $groupCondominiumRepository;

    /**
     * CommunicationController constructor.
     * @param CommunicationRepository $repository
     * @param CommunicationValidator $validator
     * @param CommunicationService $service
     * @param CondominiumRepository $condominiumRepository
     * @param UsersCondominiumRepository $usersCondominiumRepository
     * @param GroupCondominiumRepository $groupCondominiumRepository
     */
    public function __construct(CommunicationRepository $repository,
                                CommunicationValidator $validator,
                                CommunicationService $service,
                                CondominiumRepository $condominiumRepository,
                                UsersCondominiumRepository $usersCondominiumRepository, GroupCondominiumRepository $groupCondominiumRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->condominiumRepository = $condominiumRepository;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
        $this->groupCondominiumRepository = $groupCondominiumRepository;
    }

    public function index()
    {
        $dados = $this->repository->all();
        return view('portal.communication.index', compact('dados'));
    }

    public function create()
    {
        $condominium = $this->condominiumRepository->listCondominium();
        $usersCondominium = $this->usersCondominiumRepository->all();
        $groupCondominium = $this->groupCondominiumRepository->listGroupCondominium();
        //dd($groupCondominium);

        return view('portal.communication.create', compact('condominium', 'usersCondominium', 'groupCondominium'));
    }

    public function store(CommunicationRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $dados = $this->repository->find($id);
        $dados['date_display'] = date('d/m/Y', strtotime($dados['date_display']));
        $condominium = $this->condominiumRepository->listCondominium();
        $groupCondominium = $this->groupCondominiumRepository->listGroupCondominium();

        $usersCondominium = $this->usersCondominiumRepository->all();

        return view('portal.communication.edit', compact('dados', 'condominium', 'usersCondominium', 'groupCondominium'));
    }

    public function update(CommunicationRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'Communication' => 'UsersRole deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('Communication', 'UsersRole deleted.');
    }
}
