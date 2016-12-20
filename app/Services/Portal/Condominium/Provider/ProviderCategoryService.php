<?php

namespace CentralCondo\Services\Portal\Condominium\Provider;

use CentralCondo\Repositories\Portal\Condominium\Provider\ProviderCategoryRepository;
use CentralCondo\Repositories\Portal\Condominium\Provider\ProvidersRepository;
use CentralCondo\Validators\Portal\Condominium\Provider\ProviderCategoryValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ProviderCategoryService
{

    protected $repository;

    protected $validator;

    protected $providersRepository;

    public function __construct(ProviderCategoryRepository $repository,
                                ProviderCategoryValidator $validator,
                                ProvidersRepository $providersRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->providersRepository = $providersRepository;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function create(array $data)
    {
        $verificaName = $this->repository->findWhere([
            'name' => $data['name'],
            'condominium_id' => $this->condominium_id
        ]);

        if ($verificaName->toArray()) {
            $response = trans("Categoria já cadastrada com este nome");
            return redirect()->back()->withErrors($response)->withInput();
        } else {
            $data['condominium_id'] = $this->condominium_id;
            try {
                $this->validator->with($data)->passesOrFail();
                $dados = $this->repository->create($data);
                if ($dados) {
                    $response = trans("Categoria cadastrada com sucesso!");
                    return redirect()->back()->with('status', trans($response));
                }
            } catch (ValidatorException $e) {
                $response = trans("Erro ao cadastrar a Categoria");
                return redirect()->back()->withErrors($response)->withInput();
            }
        }
    }

    public function update(array $data, $id)
    {
        $verificaName = $this->repository->findWhere([
            'name' => $data['name'],
            'condominium_id' => $this->condominium_id,
            ['id', '!=', $id]
        ]);

        if ($verificaName->toArray()) {
            $response = trans("Categoria já cadastrada com este nome");
            return redirect()->back()->withErrors($response)->withInput();
        } else {
            try {
                $data['condominium_id'] = $this->condominium_id;
                $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
                $dados = $this->repository->update($data, $id);

                if ($dados) {
                    $response = trans("Categoria alterada com sucesso!");
                    return redirect()->back()->with('status', trans($response));
                }

            } catch (ValidatorException $e) {
                $response = trans("Erro ao alterar a Categoria");
                return redirect()->back()->withErrors($response)->withInput();
            }
        }
    }

    public function destroy($id)
    {
        $verifica = $this->providersRepository->findWhere(['provider_category_id' => $id]);
        if ($verifica->toArray()) {
            $response = trans("Não é possível exluir esta categoria, existe fornecedores vinculados a mesma!");
            return redirect()->back()->withErrors($response)->withInput();
        } else {
            $deleted = $this->repository->delete($id);
            $response = trans("Categoria removida com sucesso!");
            return redirect()->back()->with('status', trans($response));
        }
    }

}