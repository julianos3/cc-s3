<?php

namespace CentralCondo\Services\Portal\Manage\Contract;

use CentralCondo\Repositories\Portal\Manage\Contract\ContractFileRepository;
use CentralCondo\Services\Util\UtilObjeto;
use CentralCondo\Validators\Portal\Manage\Contract\ContractFileValidator;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use Prettus\Validator\Exceptions\ValidatorException;

class ContractFileService
{

    /**
     * @var ContractFileRepository
     */
    protected $repository;

    /**
     * @var ContractFileValidator
     */
    protected $validator;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var Storage
     */
    protected $storage;

    protected $utilObjeto;

    public function __construct(ContractFileRepository $repository,
                                ContractFileValidator $validator,
                                Filesystem $filesystem,
                                Storage $storage,
                                UtilObjeto $utilObjeto)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->storage = $storage;
        $this->filesystem = $filesystem;
        $this->utilObjeto = $utilObjeto;
        $this->condominium_id = session()->get('condominium_id');
        $this->path = 'portal/' . $this->condominium_id . '/manage/contract/';
    }

    public function createMultiple($id, array $data)
    {
        $file_count = count($data['files']);
        $uploadcount = 0;
        foreach ($data['files'] as $file) {

            $validator = 'png,gif,jpeg,txt,pdf,doc,docx';
            $result = $this->utilObjeto->upload($file, $this->path, $validator);

            if ($result) {
                $dados['contract_id'] = $id;
                $dados['name'] = $result['name'];
                $dados['file'] = $result['file'];
                $dados['extension'] = $result['extension'];
                $this->create($dados);

                $uploadcount++;
            }
        }

        if ($uploadcount == $file_count) {
            return true;
        } else {
            return false;
        }
    }

    public function create(array $data)
    {

        try {
            $data['condominium_id'] = $this->condominium_id;
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if ($dados) {
                $response = trans("Recurso Comum cadastrado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao cadastrar o Recurso Comum");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function update(array $data, $id)
    {
        try {
            $data['condominium_id'] = $this->condominium_id;
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->update($data, $id);

            if ($dados) {
                $response = trans("Recurso Comum alterado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao alterar o Recurso Comum");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function destroy($id)
    {
        $dados = $this->repository->find($id);
        $deleted = $this->repository->delete($id);
        if ($deleted) {

            if ($this->storage->exists($this->path . $dados['file'])) {
                $this->storage->delete($this->path . $dados['file']);
            }

            $response = trans("Arquivo excluido com sucesso!");
            return redirect()->back()->with('status', trans($response));
        } else {
            $response = trans("Erro ao excluir arquivo");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function getBaseURL($user)
    {
        switch ($this->storage->getDefaultDriver()) {
            case 'local':
                return $this->storage->getDriver()->getAdapter()->getPathPrefix()
                . '/' . $this->getFileName($user['id']);
        }
    }

    public function getFileName($id)
    {
        $file = $this->repository->skipPresenter()->find($id);
        return $file['name'];
    }

}