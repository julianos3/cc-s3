<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Entities\Portal\UsersCondominium;
use CentralCondo\Repositories\Portal\DiaryRepository;
use CentralCondo\Repositories\Portal\UsersCondominiumRepository;
use CentralCondo\Services\Portal\UsersDiaryService;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Requests\Portal\UsersDiaryRequest;
use CentralCondo\Repositories\Portal\UsersDiaryRepository;
use CentralCondo\Validators\Portal\UsersDiaryValidator;
use CentralCondo\Http\Controllers\Controller;

class UsersDiaryController extends Controller
{
    /**
     * @var UsersDiaryRepository
     */
    protected $repository;

    /**
     * @var UsersDiaryValidator
     */
    protected $validator;

    /**
     * @var UsersDiaryService
     */
    private $service;

    /**
     * @var UsersCondominium
     */
    private $usersCondominiumRepository;

    /**
     * @var DiaryRepository
     */
    private $diaryRepository;

    /**
     * UsersDiaryController constructor.
     * @param UsersDiaryRepository $repository
     * @param UsersDiaryValidator $validator
     * @param UsersDiaryService $service
     * @param UsersCondominiumRepository $usersCondominium
     * @param DiaryRepository $diaryRepository
     */
    public function __construct(UsersDiaryRepository $repository,
                                UsersDiaryValidator $validator,
                                UsersDiaryService $service,
                                UsersCondominiumRepository $usersCondominium,
                                DiaryRepository $diaryRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->usersCondominiumRepository = $usersCondominium;
        $this->diaryRepository = $diaryRepository;
    }

    public function index($diaryId)
    {
        $dados = $this->repository->findWhere([
            'diary_id' => $diaryId
        ]);
        return view('portal.diary.user.index', compact('dados', 'diaryId'));
    }

    public function create($diaryId)
    {
        $condominiumId = $this->diaryRepository->getCondominiumId($diaryId);
        $usersCondominium = $this->usersCondominiumRepository->listUsersCondominiumFind($condominiumId);

        return view('portal.diary.user.create', compact('usersCondominium', 'diaryId'));
    }

    public function store(UsersDiaryRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function edit($diaryId, $id)
    {
        $dados = $this->repository->find($id);
        $condominiumId = $this->diaryRepository->getCondominiumId($diaryId);
        $usersCondominium = $this->usersCondominiumRepository->listUsersCondominiumFind($condominiumId);

        return view('portal.diary.user.edit', compact('dados', 'usersCondominium', 'diaryId'));
    }

    public function update(UsersDiaryRequest $request, $diaryId, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($diaryId, $id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Group deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UsersRole deleted.');
    }
}
