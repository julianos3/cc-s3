<?php

namespace CentralCondo\Services\Portal\Condominium\Provider;

use CentralCondo\Repositories\Portal\Condominium\Provider\ProvidersRepository;
use CentralCondo\Repositories\Portal\Manage\Contract\ContractRepository;
use CentralCondo\Validators\Portal\Condominium\Provider\ProvidersValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ProvidersService
{

    /**
     * @var ProvidersRepository
     */
    protected $repository;

    /**
     * @var ProvidersValidator
     */
    protected $validator;

    /**
     * @var ContractRepository
     */
    protected $contractRepository;

    public function __construct(ProvidersRepository $repository,
                                ProvidersValidator $validator,
                                ContractRepository $contractRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->contractRepository = $contractRepository;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function create(array $data)
    {
        try {
            $data['condominium_id'] = $this->condominium_id;
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if ($dados) {
                $response = trans("Fornecedor cadastrado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = [
                'error' => true,
                'message' => $e->getMessageBag()
            ];

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function update(array $data, $id)
    {
        try {
            $data['condominium_id'] = $this->condominium_id;
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $dados = $this->repository->update($data, $id);

            if ($dados) {
                $response = trans("Fornecedor alterado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {

            $response = response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function destroy($id)
    {
        //verifica
        $contract = $this->contractRepository->findWhere(['provider_id' => $id]);
        if ($contract->toArray()) {
            $response = trans('Não é possível exluir este fonecedor, existe contratos vinculados ao mesmo!');
            return redirect()->back()->withErrors($response)->withInput();
        } else {
            $deleted = $this->repository->delete($id);
            $response = trans("Fornecedor removido com sucesso!");
            return redirect()->back()->with('status', trans($response));
        }
    }

}