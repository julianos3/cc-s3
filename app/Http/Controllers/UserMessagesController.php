<?php

namespace CentralCondo\Http\Controllers;

use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CentralCondo\Http\Requests\UserMessageCreateRequest;
use CentralCondo\Http\Requests\UserMessageUpdateRequest;
use CentralCondo\Repositories\UserMessageRepository;
use CentralCondo\Validators\UserMessageValidator;


class UserMessagesController extends Controller
{

    /**
     * @var UserMessageRepository
     */
    protected $repository;

    /**
     * @var UserMessageValidator
     */
    protected $validator;

    public function __construct(UserMessageRepository $repository, UserMessageValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $userMessages = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userMessages,
            ]);
        }

        return view('userMessages.index', compact('userMessages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserMessageCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserMessageCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $userMessage = $this->repository->create($request->all());

            $response = [
                'message' => 'UserMessage created.',
                'data'    => $userMessage->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userMessage = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userMessage,
            ]);
        }

        return view('userMessages.show', compact('userMessage'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $userMessage = $this->repository->find($id);

        return view('userMessages.edit', compact('userMessage'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  UserMessageUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(UserMessageUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $userMessage = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'UserMessage updated.',
                'data'    => $userMessage->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'UserMessage deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UserMessage deleted.');
    }
}
