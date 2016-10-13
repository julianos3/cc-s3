<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Services\Portal\UsersRoleService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CentralCondo\Http\Requests\Portal\UsersRoleRequest;
use CentralCondo\Repositories\Portal\UsersRoleRepository;
use CentralCondo\Validators\Portal\UsersRoleValidator;
use CentralCondo\Http\Controllers\Controller;


class UsersRolesController extends Controller
{

    /**
     * @var UsersRoleRepository
     */
    protected $repository;

    /**
     * @var UsersRoleValidator
     */
    protected $validator;

    /**
     * @var UsersRoleService
     */
    private $service;

    /**
     * UsersRolesController constructor.
     * @param UsersRoleRepository $repository
     * @param UsersRoleValidator $validator
     * @param UsersRoleService $service
     */
    public function __construct(UsersRoleRepository $repository, UsersRoleValidator $validator, UsersRoleService $service)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->repository->all();
        return view('portal.user.role.index', compact('data'));
    }

    public function create()
    {
        return view('portal.user.role.create');
    }

    public function store(UsersRoleRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($id)
    {
        $data = $this->repository->find($id);

        return view('portal.user.role.edit', compact('data'));
    }

    public function update(UsersRoleRequest $request, $id)
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
