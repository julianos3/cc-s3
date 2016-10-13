<?php

namespace CentralCondo\Http\Controllers\Portal\Condominium;

use CentralCondo\Repositories\Portal\Condominium\Block\BlockNomemclatureRepository;
use CentralCondo\Repositories\Portal\Condominium\Block\BlockRepository;
use CentralCondo\Repositories\Portal\Condominium\FinalityRepository;
use CentralCondo\Repositories\Portal\Condominium\Unit\UsersUnitRoleRepository;
use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Repositories\Portal\Condominium\UsersRoleCondominiumRepository;
use CentralCondo\Repositories\Portal\StateRepository;
use CentralCondo\Repositories\Portal\Condominium\Unit\UnitRepository;
use CentralCondo\Repositories\Portal\Condominium\Unit\UnitTypeRepository;
use CentralCondo\Services\Portal\Condominium\CondominiumService;
use CentralCondo\Services\Portal\Condominium\Unit\UnitService;
use CentralCondo\Services\Portal\Condominium\Unit\UsersUnitService;
use CentralCondo\Services\Portal\Condominium\UsersCondominiumService;
use CentralCondo\Services\Portal\UserService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Repositories\Portal\Condominium\CondominiumRepository;
use CentralCondo\Validators\Portal\Condominium\CondominiumValidator;
use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests\Portal\Condominium\CondominiumRequest;
use Illuminate\Support\Facades\Auth;


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
     * @var CondominiumService
     */
    protected $service;

    /**
     * @var FinalityRepository
     */
    protected $finalityRepository;

    /**
     * @var StateRepository
     */
    protected $stateRepository;

    /**
     * @var UnitTypeRepository
     */
    protected $unitTypeRepository;

    /**
     * @var BlockNomemclatureRepository
     */
    protected $blockNomemclatureRepository;

    /**
     * @var UnitService
     */
    protected $unitService;

    /**
     * @var UnitRepository
     */
    protected $unitRepository;

    /**
     * @var BlockRepository
     */
    protected $blockRepository;

    /**
     * @var UsersRoleCondominiumRepository
     */
    protected $usersRoleCondominiumRepository;

    /**
     * @var
     */
    protected $condominium_id;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var UsersUnitService
     */
    protected $usersUnitService;

    /**
     * @var UsersCondominiumRepository
     */
    protected $usersCondominiumRepoistory;

    /**
     * @var UsersCondominiumService
     */
    protected $usersCondominiumService;

    /**
     * @var UsersUnitRoleRepository
     */
    protected $usersUnitRoleRepository;

    /**
     * CondominiumController constructor.
     * @param CondominiumRepository $repository
     * @param CondominiumValidator $validator
     * @param CondominiumService $service
     * @param FinalityRepository $finalityRepository
     * @param StateRepository $stateRepository
     * @param UnitTypeRepository $unitTypeRepository
     * @param BlockNomemclatureRepository $blockNomemclatureRepository
     * @param UnitService $unitService
     * @param UnitRepository $unitRepository
     * @param BlockRepository $blockRepository
     * @param UsersRoleCondominiumRepository $usersRoleCondominiumRepository
     * @param UserService $userService
     * @param UsersUnitService $usersUnitService
     * @param UsersCondominiumRepository $usersCondominiumRepository
     * @param UsersCondominiumService $usersCondominiumService
     * @param UsersUnitRoleRepository $usersUnitRoleRepository
     */
    public function __construct(CondominiumRepository $repository,
                                CondominiumValidator $validator,
                                CondominiumService $service,
                                FinalityRepository $finalityRepository,
                                StateRepository $stateRepository,
                                UnitTypeRepository $unitTypeRepository,
                                BlockNomemclatureRepository $blockNomemclatureRepository,
                                UnitService $unitService,
                                UnitRepository $unitRepository,
                                BlockRepository $blockRepository,
                                UsersRoleCondominiumRepository $usersRoleCondominiumRepository,
                                UserService $userService,
                                UsersUnitService $usersUnitService,
                                UsersCondominiumRepository $usersCondominiumRepository,
                                UsersCondominiumService $usersCondominiumService,
                                UsersUnitRoleRepository $usersUnitRoleRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->finalityRepository = $finalityRepository;
        $this->stateRepository = $stateRepository;
        $this->unitTypeRepository = $unitTypeRepository;
        $this->blockNomemclatureRepository = $blockNomemclatureRepository;
        $this->unitService = $unitService;
        $this->unitRepository = $unitRepository;
        $this->blockRepository = $blockRepository;
        $this->usersRoleCondominiumRepository = $usersRoleCondominiumRepository;
        $this->userService = $userService;
        $this->usersUnitService = $usersUnitService;
        $this->usersCondominiumRepoistory = $usersCondominiumRepository;
        $this->usersCondominiumService = $usersCondominiumService;
        $this->usersUnitRoleRepository = $usersUnitRoleRepository;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $dados = $this->repository->all();

        return view('portal.condominium.index', compact('dados'));
    }

    public function create()
    {
        $config['title'] = "Novo condomínio";
        $finality = $this->finalityRepository->listFinality();
        $state = $this->stateRepository->all();

        return view('portal.condominium.create', compact('config', 'finality', 'state'));
    }

    public function store(CondominiumRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function createInfo()
    {
        $config['title'] = "Informação do condomínio";
        $dados = $this->repository->find($this->condominium_id);
        $finality = $this->finalityRepository->findWhere(['active' => 'y']);

        return view('portal.condominium.create_info', compact('config', 'finality', 'dados'));
    }

    public function createConfig()
    {
        $config['title'] = "Condiguração do condomínio";
        $dados = $this->repository->find($this->condominium_id);
        $unitType = $this->unitTypeRepository->findWhere(['active' => 'y']);
        $blockNomemclature = $this->blockNomemclatureRepository->findWhere(['active' => 'y']);
        $unit = $this->unitRepository->findWhere([
            'condominium_id' => $this->condominium_id
        ]);

        return view('portal.condominium.create_config', compact('config', 'dados', 'unitType', 'unit', 'blockNomemclature'));
    }

    public function createUnit(CondominiumRequest $request)
    {
        $id = $this->condominium_id;
        return $this->service->createUnits($request->all(), $id);
    }

    public function edit()
    {
        $config['title'] = "Editando Condomínio";
        $dados = $this->repository->find($this->condominium_id);
        $finality = $this->finalityRepository->listFinality();
        $state = $this->stateRepository->all();
        return view('portal.condominium.edit', compact('config', 'dados', 'state', 'finality'));
    }

    public function updateInfo(CondominiumRequest $request)
    {
        $id = $this->condominium_id;
        return $this->service->updateInfo($request->all(), $id);
    }

    public function update(CondominiumRequest $request)
    {
        return $this->service->update($request->all(), $this->condominium_id);
    }

    public function finish()
    {
        $config['title'] = "Conclusão cadastro do condomínio";

        $userRole = $this->usersRoleCondominiumRepository->findWhere(['active' => 'y']);
        $block = $this->blockRepository->findWhere([
            'condominium_id' => $this->condominium_id]
        );
        $userUnitRole = $this->usersUnitRoleRepository->findWhere(['active' => 'y']);
        $dados = $this->repository->find($this->condominium_id);

        return view('portal.condominium.create_finish', compact('config', 'dados', 'userRole', 'block', 'userUnitRole'));
    }

    public function finishStore(CondominiumRequest $request)
    {
        $userCondominiumId = $this->usersCondominiumRepoistory->findWhere([
            'user_id' => Auth::user()->id,
            'condominium_id' => $this->condominium_id
        ]);

        $data = $request->all();

        //adicionar nivel | users condominium -> user_role_id
        $user['user_id'] = Auth::user()->id;
        $user['user_role_condominium'] = $data['user_role_condominium'];
        $user['condominium_id'] = $this->condominium_id;
        $this->usersCondominiumService->update($user, $userCondominiumId[0]->id);

        $unit['user_condominium_id'] = $userCondominiumId[0]->id;
        $unit['unit_id'] = $data['unit_id'];
        $unit['user_unit_role'] = $data['user_unit_role'];

        $this->usersUnitService->create($unit);

        return redirect(route('portal.home.index'));
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

    public function clearUnitBlock()
    {
        if($this->service->clearUnitBlock($this->condominium_id)){
            $response = 'Todas as unidades removidas com sucesso!';
            return redirect()->back()->with('status', trans($response));
        }else{
            $response = 'Erro inesperado ao remover unidades!';
            return redirect()->back()->withErrors(trans($response))->withInput();
        }

    }

}
