<?php

namespace CentralCondo\Http\Controllers\Portal\Condominium\Unit;

use CentralCondo\Repositories\Portal\Condominium\CondominiumRepository;
use CentralCondo\Repositories\Portal\Condominium\Unit\UnitRepository;
use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Services\Portal\Condominium\Unit\UsersUnitService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\Condominium\Unit\UsersUnitRequest;
use CentralCondo\Repositories\Portal\Condominium\Unit\UsersUnitRepository;
use CentralCondo\Validators\Portal\Condominium\Unit\UsersUnitValidator;
use CentralCondo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;


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
     * @param UsersUnitService $service
     * @param UnitRepository $unitRepository
     * @param UsersCondominiumRepository $usersCondominiumRepository
     */
    public function __construct(UsersUnitRepository $repository,
                                UsersUnitService $service,
                                UnitRepository $unitRepository,
                                UsersCondominiumRepository $usersCondominiumRepository)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->unitRepository = $unitRepository;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
        $this->condominium_id = session()->get('condominium_id');
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

    public function storeJson(UsersUnitRequest $request)
    {
        return Response::json($this->service->create($request->all()));
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
        return $this->service->destroy($id);
    }

    public function listAll(UsersUnitRequest $request)
    {
        $units = $this->repository->findWhere(['user_condominium_id' => $request->user_condominium_id]);
        $html = '';

        if (!$units->isEmpty()) {
            $html .= '<div class="col-md-12" >
            <table class="tablesaw table-striped table-bordered table-hover"
                   data - tablesaw - mode = "swipe"
                   data - tablesaw - sortable data - tablesaw - minimap >
                <thead >
                <tr >
                    <th data - tablesaw - sortable - col data - tablesaw - sortable -default-col
                        data - tablesaw - priority = "persist" > Unidade
                    </th >
                    <th data - tablesaw - sortable - col data - tablesaw - priority = "3" > Andar</th>
                    <th data - tablesaw - sortable - col data - tablesaw - priority = "2" > Bloco</th>
                    <th data - tablesaw - sortable - col data - tablesaw - priority = "1" > Tipo</th>
                    <th class="text-center col-md-2" >Ação</th>
                </tr >
                </thead >
                <tbody >';

            foreach ($units as $row) {
                $html .= '
                    <tr >
                        <td>' . $row->unit->name . '</td>
                        <td>' . $row->unit->floor . '</td>
                        <td>' . $row->unit->block->name . '</td>
                        <td>' . $row->unit->unitType->name . '</td>
                        <td class="text-center" >
                            <button title = "Excluir"
                                    class="btn btn-icon bg-danger waves-effect waves-light btnDelete"
                                    data - target = "#modalDelete" data - toggle = "modal"
                                    data - route = "{{ route(\'portal.condominium.unit.user.destroy\', [\'id\' => $row->id]) }}" >
                                <i class="icon wb-trash" aria - hidden = "true" ></i >
                            </button >
                        </td >
                    </tr >';
            }
            $html .= '
                </tbody >
            </table >
        </div >';
        } else {
            $html .= '<div class="col-md-12" ><h4 class="page-title" ><br />Nenhuma unidade vinculada.</h4></div>';
        }

        return $html;

    }

}
