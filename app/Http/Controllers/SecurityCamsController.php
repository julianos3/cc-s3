<?php

namespace CentralCondo\Http\Controllers;

use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CentralCondo\Http\Requests\SecurityCamCreateRequest;
use CentralCondo\Http\Requests\SecurityCamUpdateRequest;
use CentralCondo\Repositories\SecurityCamRepository;
use CentralCondo\Validators\SecurityCamValidator;


class SecurityCamsController extends Controller
{

    /**
     * @var SecurityCamRepository
     */
    protected $repository;

    /**
     * @var SecurityCamValidator
     */
    protected $validator;

    public function __construct(SecurityCamRepository $repository, SecurityCamValidator $validator)
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
        $securityCams = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $securityCams,
            ]);
        }

        return view('securityCams.index', compact('securityCams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SecurityCamCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SecurityCamCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $securityCam = $this->repository->create($request->all());

            $response = [
                'message' => 'SecurityCam created.',
                'data'    => $securityCam->toArray(),
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
        $securityCam = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $securityCam,
            ]);
        }

        return view('securityCams.show', compact('securityCam'));
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

        $securityCam = $this->repository->find($id);

        return view('securityCams.edit', compact('securityCam'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  SecurityCamUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(SecurityCamUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $securityCam = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'SecurityCam updated.',
                'data'    => $securityCam->toArray(),
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
                'message' => 'SecurityCam deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'SecurityCam deleted.');
    }
}
