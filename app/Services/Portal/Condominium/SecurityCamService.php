<?php

namespace CentralCondo\Services\Portal\Condominium;

use CentralCondo\Repositories\Portal\Condominium\SecurityCamRepository;
use CentralCondo\Validators\Portal\Condominium\SecurityCamValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class SecurityCamService //regras de negocios
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
        $this->validator = $validator;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function create(array $data)
    {

        try {
            $data['condominium_id'] = $this->condominium_id;
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if($dados) {
                $response = trans("Câmera de segurança cadastrada com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao cadastrar a câmera de segurança");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function update(array $data, $id)
    {
        try {
            $data['condominium_id'] = $this->condominium_id;
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->update($data, $id);

            if($dados) {
                $response = trans("Câmera de segurança alterado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao alterar a câmera de segurança");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        if ($deleted) {
            $response = trans("Câmera de segurança excluida com sucesso!");
            return redirect()->back()->with('status', trans($response));
        } else {
            $response = trans("Erro ao excluir a câmera de segurança");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

}