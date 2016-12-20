<?php

namespace CentralCondo\Http\Controllers\Portal\Manage\Contract;

use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Http\Requests;
use CentralCondo\Repositories\Portal\Manage\Contract\ContractFileRepository;
use CentralCondo\Services\Portal\Manage\Contract\ContractFileService;
use Illuminate\Support\Facades\Storage;

class ContractFileController extends Controller
{
    /**
     * @var ContractFileRepository
     */
    protected $repository;

    /**
     * @var ContractFileService
     */
    private $service;

    /**
     * ContractFileController constructor.
     * @param ContractFileRepository $repository
     * @param ContractFileService $service
     */
    public function __construct(ContractFileRepository $repository,
                                ContractFileService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->condominium_id = session()->get('condominium_id');
        $this->path = 'portal/' . $this->condominium_id . '/manage/contract/';
    }

    public function show($id)
    {
        $dados = $this->repository->find($id);
        $file = Storage::get($this->path . $dados['file']);

        $fileContents = Storage::get($this->path . $dados['file']);
        $fileMimeType = Storage::getMimeType($this->path . $dados['file']); // e.g. 'application/pdf', 'text/plain' etc.
        //$fileNameFromStorage = basename($pathToFile); // strips the path and returns filename with extension

        $headers = array_merge([
            //'Content-Disposition' => str_replace('%name', $fileNameFromStorage, "inline; filename=\"%name\"; filename*=utf-8''%name"),
            'Content-Length' => strlen($fileContents),
            'Content-Type' => $fileMimeType,
        ], []);

        $response = response($file, 200);
        $response->header('Content-Type', $headers);

        return $response;
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
