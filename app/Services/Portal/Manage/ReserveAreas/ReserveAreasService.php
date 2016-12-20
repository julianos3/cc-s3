<?php

namespace CentralCondo\Services\Portal\Manage\ReserveAreas;

use CentralCondo\Repositories\Portal\Condominium\Diary\DiaryRepository;
use CentralCondo\Repositories\Portal\Manage\ReserveAreas\ReserveAreasRepository;
use CentralCondo\Validators\Portal\Manage\ReserveAreas\ReserveAreasValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ReserveAreasService
{

    protected $repository;

    protected $validator;

    protected $diaryRepository;

    public function __construct(ReserveAreasRepository $repository,
                                ReserveAreasValidator $validator,
                                DiaryRepository $diaryRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->diaryRepository = $diaryRepository;
        $this->condominium_id = session()->get('condominium_id');
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
        $diary = $this->diaryRepository->findWhere([
            'condominium_id' => $this->condominium_id,
            'reserve_area_id' => $id
        ]);

        if ($diary->toArray()) {
            $response = trans('Existe agenda vinculada a este recurso comum!');
            return redirect()->back()->withErrors($response)->withInput();
        } else {
            $deleted = $this->repository->delete($id);
            if ($deleted) {
                $response = trans("Rescurso Comum excluido com sucesso!");
                return redirect()->back()->with('status', trans($response));
            } else {
                $response = trans("Erro ao excluir o Rescurso Comum");
                return redirect()->back()->withErrors($response)->withInput();
            }
        }
    }

}