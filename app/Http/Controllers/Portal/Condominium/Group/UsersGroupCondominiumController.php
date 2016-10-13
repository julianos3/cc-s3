<?php

namespace CentralCondo\Http\Controllers\Portal\Condominium\Group;

use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Services\Portal\Condominium\Group\UsersGroupCondominiumService;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Condominium\Group\UsersGroupCondominiumRequest;
use CentralCondo\Repositories\Portal\Condominium\Group\UsersGroupCondominiumRepository;
use CentralCondo\Validators\Portal\Condominium\Group\UsersGroupCondominiumValidator;
use CentralCondo\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersGroupCondominiumController extends Controller
{
    /**
     * @var UsersGroupCondominiumRepository
     */
    protected $repository;

    /**
     * @var UsersGroupCondominiumValidator
     */
    protected $validator;

    /**
     * @var UsersGroupCondominiumService
     */
    private $service;

    /**
     * @var UsersCondominium
     */
    private $usersCondominiumRepository;

    /**
     * UsersGroupCondominiumController constructor.
     * @param UsersGroupCondominiumRepository $repository
     * @param UsersGroupCondominiumValidator $validator
     * @param UsersGroupCondominiumService $service
     * @param UsersCondominiumRepository $usersCondominium
     */
    public function __construct(UsersGroupCondominiumRepository $repository,
                                UsersGroupCondominiumValidator $validator,
                                UsersGroupCondominiumService $service,
                                UsersCondominiumRepository $usersCondominium)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->usersCondominiumRepository = $usersCondominium;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index($groupId)
    {
        $config['title'] = "Integrantes do Grupo";
        $dados = $this->repository->with(['usersCondominium'])->findWhere([
            'group_id' => $groupId
        ]);

        $currentPage = Paginator::resolveCurrentPage() - 1;
        $perPage = 15;
        $currentPageSearchResults = $dados->slice($currentPage * $perPage, $perPage)->all();
        $dados  = new LengthAwarePaginator($currentPageSearchResults, count($dados), $perPage);

        $usersCondominium = $this->usersCondominiumRepository->listUsersCondominiumFind($this->condominium_id);

        return view('portal.condominium.group.user.index', compact('config', 'dados', 'groupId', 'usersCondominium'));
    }

    public function create($groupId)
    {
        $config['title'] = "Cadastrar integrante no Grupo";
        $usersCondominium = $this->usersCondominiumRepository->listUsersCondominiumFind($this->condominium_id);

        return view('portal.condominium.group.user.create', compact('config', 'usersCondominium', 'groupId'));
    }

    public function store(UsersGroupCondominiumRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function destroy($groupId, $id)
    {
        return $this->service->destroy($id);
    }
}
