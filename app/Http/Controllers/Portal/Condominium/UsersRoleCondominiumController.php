<?php

namespace CentralCondo\Http\Controllers\Portal\Condominium;

use CentralCondo\Services\Portal\Condominium\UsersRoleCondominiumService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CentralCondo\Http\Requests\Portal\Condominium\UsersRoleCondominiumRequest;
use CentralCondo\Repositories\Portal\Condominium\UsersRoleCondominiumRepository;
use CentralCondo\Validators\Portal\Condominium\UsersRoleCondominiumValidator;
use CentralCondo\Http\Controllers\Controller;


class UsersRoleCondominiumController extends Controller
{

    /**
     * @var UsersRoleCondominiumRepository
     */
    protected $repository;

    /**
     * @var UsersRoleCondominiumValidator
     */
    protected $validator;

    /**
     * @var UsersRoleCondominiumService
     */
    private $service;

    /**
     * UsersRoleCodominiumController constructor.
     * @param UsersRoleCondominiumRepository $repository
     * @param UsersRoleCondominiumValidator $validator
     * @param UsersRoleCondominiumService $service
     */
    public function __construct(UsersRoleCondominiumRepository $repository, UsersRoleCondominiumValidator $validator, UsersRoleCondominiumService $service)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->repository->all();
        return view('portal.condominium.role.index', compact('data'));
    }

    public function create()
    {
        return view('portal.condominium.role.create');
    }

    public function store(UsersRoleCondominiumRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $data = $this->repository->find($id);

        return view('portal.condominium.role.edit', compact('data'));
    }

    public function update(UsersRoleCondominiumRequest $request, $id)
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
