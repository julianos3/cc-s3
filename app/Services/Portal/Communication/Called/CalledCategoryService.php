<?php

namespace CentralCondo\Services\Portal\Communication\Called;

use CentralCondo\Repositories\Portal\Communication\Called\CalledCategoryRepository;
use CentralCondo\Repositories\Portal\Communication\Called\CalledRepository;
use CentralCondo\Validators\Portal\Communication\Called\CalledCategoryValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class CalledCategoryService //regras de negocios
{

    /**
     * @var CalledCategoryRepository
     */
    protected $repository;

    /**
     * @var CalledCategoryValidator
     */
    protected $validator;

    protected $calledRepository;

    public function __construct(CalledCategoryRepository $repository,
                                CalledCategoryValidator $validator,
                                CalledRepository $calledRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->calledRepository = $calledRepository;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function create(array $data)
    {

        try {
            $data['condominium_id'] = $this->condominium_id;
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

    public function update(array $data, $id)
    {
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

    public function destroy($id)
    {
        $called = $this->calledRepository->findWhere(['called_category_id' => $id, 'condominium_id' => $this->condominium_id]);
        if ($called->toArray()) {
            $response = trans('Categoria vinculado à chamados.');
            return redirect()->back()->withErrors($response)->withInput();
        } else {
            $deleted = $this->repository->delete($id);
            if ($deleted) {
                $response = trans("Categroia excluida com sucesso!");
                return redirect()->back()->with('status', trans($response));
            } else {
                $response = trans("Erro ao excluir a Categoria");
                return redirect()->back()->withErrors($response)->withInput();
            }
        }
    }

}