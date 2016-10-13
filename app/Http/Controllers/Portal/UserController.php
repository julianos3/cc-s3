<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Repositories\Portal\Condominium\Block\BlockRepository;
use CentralCondo\Services\Portal\UserService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CentralCondo\Repositories\Portal\UserRepository;
use CentralCondo\Validators\Portal\UserValidator;
use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests\Portal\UserRequest;
use CentralCondo\Repositories\Portal\UsersRoleRepository;


class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * @var UsersRoleRepository
     */
    protected $roleRepository;

    /**
     * @var UserService
     */
    protected $service;

    /**
     * @var BlockRepository
     */
    protected $blockRepository;

    /**
     * UserController constructor.
     * @param UserRepository $repository
     * @param UserValidator $validator
     * @param UsersRoleRepository $roleRepository
     * @param UserService $service
     * @param BlockRepository $blockRepository
     */
    public function __construct(UserRepository $repository,
                                UserValidator $validator,
                                UsersRoleRepository $roleRepository,
                                UserService $service,
                                BlockRepository $blockRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->roleRepository = $roleRepository;
        $this->service = $service;
        $this->blockRepository = $blockRepository;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $dados = $this->repository->all();

        return view('portal.user.index', compact('dados'));
    }

    public function create()
    {
        $config['title'] = "Novo integrante";
        $role = $this->roleRepository->listRole();
        $userRole = $this->roleRepository->listRole(); //puxar role unit que deve ser criado
        $block = $this->blockRepository->findWhere([
            'condominium_id' => $this->condominium_id
        ]);

        return view('portal.condominium.user.create', compact('config', 'block', 'role', 'userRole'));
    }

    public function store(UserRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id)
    {
        $dados = $this->repository->find($id);
        return view('portal.user.show', compact('dados'));
    }

    public function edit($id)
    {
        $dados = $this->repository->find($id);
        $role = $this->roleRepository->listRole();
        return view('portal.user.edit', compact('dados', 'role'));
    }

    public function update(UserRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'UsersCondominium deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UsersCondominium deleted.');
    }

    public function showImage($id)
    {
        $user = $this->repository->find($id);
        $path = 'user/'.$id.'/';
        $imagem = explode('.',$user['imagem']);
        $file = Storage::get($path.$imagem[0]);

        return response($file, 200)->header('Content-Type', 'image');
    }
}
