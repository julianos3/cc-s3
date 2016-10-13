<?php

namespace CentralCondo\Http\Controllers\Portal\Condominium\Group;

use CentralCondo\Repositories\Portal\Condominium\CondominiumRepository;
use CentralCondo\Repositories\Portal\Condominium\Group\UsersGroupCondominiumRepository;
use CentralCondo\Services\Portal\Condominium\Group\GroupCondominiumService;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Condominium\Group\GroupCondominiumRequest;
use CentralCondo\Repositories\Portal\Condominium\Group\GroupCondominiumRepository;
use CentralCondo\Validators\Portal\Condominium\Group\GroupCondominiumValidator;
use CentralCondo\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class GroupCondominiumController extends Controller
{
    /**
     * @var GroupCondominiumRepository
     */
    protected $repository;

    /**
     * @var GroupCondominiumValidator
     */
    protected $validator;

    /**
     * @var GroupCondominiumService
     */
    private $service;

    /**
     * @var CondominiumRepository
     */
    private $condominiumRepository;

    /**
     * @var UsersGroupCondominiumRepository
     */
    private $usersGroupCondominiumRepository;

    /**
     * GroupCondominiumController constructor.
     * @param GroupCondominiumRepository $repository
     * @param GroupCondominiumValidator $validator
     * @param GroupCondominiumService $service
     * @param CondominiumRepository $condominiumRepository
     * @param UsersGroupCondominiumRepository $usersGroupCondominiumRepository
     */
    public function __construct(GroupCondominiumRepository $repository,
                                GroupCondominiumValidator $validator,
                                GroupCondominiumService $service,
                                CondominiumRepository $condominiumRepository,
                                UsersGroupCondominiumRepository $usersGroupCondominiumRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->condominiumRepository = $condominiumRepository;
        $this->usersGroupCondominiumRepository = $usersGroupCondominiumRepository;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $config['title'] = 'Grupos';
        $dados = $this->repository->findWhere(['condominium_id' => $this->condominium_id]);

        $currentPage = Paginator::resolveCurrentPage() - 1;
        $perPage = 15;
        $currentPageSearchResults = $dados->slice($currentPage * $perPage, $perPage)->all();
        $dados  = new LengthAwarePaginator($currentPageSearchResults, count($dados), $perPage);

        return view('portal.condominium.group.index', compact('config', 'dados'));
    }

    public function create()
    {
        $config['title'] = 'Novo Grupo';
        return view('portal.condominium.group.create', compact('config'));
    }

    public function store(GroupCondominiumRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $config['title'] = 'Editar Grupo';
        $dados = $this->repository->find($id);

        return view('portal.condominium.group.edit', compact('config', 'dados'));
    }

    public function update(GroupCondominiumRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
