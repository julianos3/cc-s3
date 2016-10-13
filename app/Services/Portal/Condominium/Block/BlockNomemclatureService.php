<?php

namespace CentralCondo\Services\Portal\Condominium\Block;

use CentralCondo\Repositories\Portal\Condominium\Block\BlockNomemclatureRepository;
use CentralCondo\Validators\Portal\Condominium\Block\BlockNomemclatureValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class BlockNomemclatureService //regras de negocios
{

    /**
     * @var BlockNomemclatureRepository
     */
    protected $repository;

    /**
     * @var BlockNomemclatureValidator
     */
    protected $validator;

    public function __construct(BlockNomemclatureRepository $repository, BlockNomemclatureValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {

        try {
            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->create($data);
            if($dados) {
                $response = [
                    'message' => 'UsersRole add.',
                    'data' => $dados->toArray(),
                ];

                return redirect()->back()->with('message', $response['message']);
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
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $dados = $this->repository->update($data, $id);

            if($dados) {
                $response = [
                    'message' => 'UsersRole updated.',
                    'data' => $dados->toArray(),
                ];

                return redirect()->back()->with('message', $response['message']);
            }
        } catch (ValidatorException $e) {

            $response = response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function trataName($id, $cont)
    {
        $nomemclature = $this->repository->find($id);
        $legenda = substr($nomemclature['label'],0,-1);

        if($nomemclature['type'] == 'n'){
            $legenda = $legenda.' ';
        }else{
            $legenda = $legenda.' ';
        }

        dd($nomemclature);
    }

}