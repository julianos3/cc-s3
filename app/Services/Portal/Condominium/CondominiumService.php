<?php

namespace CentralCondo\Services\Portal\Condominium;

use CentralCondo\Repositories\Portal\Condominium\Block\BlockNomemclatureRepository;
use CentralCondo\Repositories\Portal\Condominium\Block\BlockRepository;
use CentralCondo\Repositories\Portal\Condominium\CondominiumRepository;
use CentralCondo\Repositories\Portal\Condominium\Unit\UnitRepository;
use CentralCondo\Repositories\Portal\Condominium\Unit\UnitTypeRepository;
use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Services\Portal\Condominium\Block\BlockNomemclatureService;
use CentralCondo\Services\Portal\Condomnium\Block\BlockService;
use CentralCondo\Services\Portal\Condominium\UsersCondominiumService;
use CentralCondo\Services\Portal\UserService;
use CentralCondo\Validators\Portal\Condominium\CondominiumValidator;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class CondominiumService //regras de negocios
{

    /**
     * @var CondominiumRepository
     */
    protected $repository;

    /**
     * @var CondominiumValidator
     */
    protected $validator;

    protected $condominiumRepository;

    protected $usersCondominiumService;

    protected $blockRepository;

    protected $unitRepository;

    protected $blockNomemclatureRepository;

    protected $unitTypeRepository;

    protected $userService;

    protected $usersCondominiumRepository;

    public function __construct(CondominiumRepository $repository,
                                CondominiumValidator $validator,
                                CondominiumRepository $condominiumRepository,
                                UsersCondominiumService $usersCondominiumService,
                                BlockRepository $blockRepository,
                                UnitRepository $unitRepository,
                                BlockNomemclatureRepository $blockNomemclatureRepository,
                                UnitTypeRepository $unitTypeRepository, UserService $userService,
                                UsersCondominiumRepository $usersCondominiumRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->condominiumRepository = $condominiumRepository;
        $this->usersCondominiumService = $usersCondominiumService;
        $this->blockRepository = $blockRepository;
        $this->unitRepository = $unitRepository;
        $this->blockNomemclatureRepository = $blockNomemclatureRepository;
        $this->unitTypeRepository = $unitTypeRepository;
        $this->userService = $userService;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
    }

    public function create(array $data)
    {
        try {
            //verifica condominio já cadastrado
            $condominium = $this->condominiumRepository->findWhere([
                'zip_code' => $data['zip_code'],
                'address' => $data['address'],
                'number' => $data['number'],
                'district' => $data['district'],
                'city_id' => $data['city_id']
            ]);

                   //dd($condominium);
            if ($condominium->toArray()) {
                //cadastra usuario no condominio
                //dd($condominium[0]->id);
                //dd('cria o post de cadastro do usuario no condominio');
                $users['user_id'] = Auth::user()->id;
                $users['user_role_condominium'] = 1;
                $users['condominium_id'] = $condominium[0]->id;

                $this->usersCondominiumService->create($users);
                $this->userService->userSessionCondominion();

                return redirect(route('portal.condominium.create.finish'));
            } else {
                //cadastra condominio e segue nas demais informações do condominio
                $data['finality_id'] = 1;
                $this->validator->with($data)->passesOrFail();
                $dados = $this->repository->create($data);
                if ($dados) {
                    //cadastro do usuario no condominio
                    $users['user_id'] = Auth::user()->id;
                    $users['user_role_condominium'] = 1;
                    $users['condominium_id'] = $dados['id'];

                    $this->usersCondominiumService->create($users);

                    $response = [
                        'message' => 'Condominium add.',
                        'data' => $dados->toArray(),
                    ];

                    $this->userService->userSessionCondominion();

                    return redirect(route('portal.condominium.create.info'));
                }

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
            //verifica condominio já cadastrado
            $condominium = $this->condominiumRepository->findWhere([
                'zip_code' => $data['zip_code'],
                'address' => $data['address'],
                'number' => $data['number'],
                'district' => $data['district'],
                'city_id' => $data['city_id']
            ]);

            if ($condominium->toArray() && $condominium[0]->id != $id) {
                //remove usuario do condominio cadastrado errado
                //remove condominio cadastrado errado
                if ($this->clearUsersCondominium($id, Auth::user()->id)) {
                    $this->destroy($id);
                }

                return $this->create($data);
                /*
                //cadastra usuario no condominio
                $users['user_id'] = Auth::user()->id;
                $users['user_role_condominium'] = 1;
                $users['condominium_id'] = $condominium[0]->id;

                $this->usersCondominiumService->create($users);
                $this->userService->userSessionCondominion();

                return redirect(route('portal.condominium.create.finish'));
                */
            } else {

                $this->validator->with($data)->passesOrFail();
                $dados = $this->repository->update($data, $id);

                if ($dados) {
                    $this->userService->userSessionCondominion();

                    return redirect(route('portal.condominium.create.info'));
                }
            }
        } catch (ValidatorException $e) {

            $response = trans('Erro ao alterar condomínio');

            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        if ($deleted) {
            $response = trans("Condomínio excluido com sucesso!");
            return redirect()->back()->with('status', trans($response));
        } else {
            $response = trans("Erro ao excluir o condomínio");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function updateInfo(array $data, $id)
    {
        try {
            if ($data['cnpj'] != '  .   .   /    -  ') {
                dd('valida cnpj');
            }

            $this->validator->with($data)->passesOrFail();
            $dados = $this->repository->update($data, $id);

            if ($dados) {
                return redirect(route('portal.condominium.create.config'));
            }
        } catch (ValidatorException $e) {

            $response = trans('Erro ao editar as informações docondomínio');

            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function createUnits(array $data, $id)
    {
        try {

            if ($data['unit_type_id'] == 1 || $data['unit_type_id'] == 4 || $data['unit_type_id'] == 5) { //apartamento
                $this->createApartamentos($data, $id);
            } elseif ($data['unit_type_id'] == 2) { //casa
                $this->createCasa($data, $id);
            } elseif ($data['unit_type_id'] == 3) { //garagem
                $this->createGaragem($data, $id);
            }

            return redirect()->back()->with("Unidades cadastradas com sucesso!")->withInput();

        } catch (ValidatorException $e) {

            $response = response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function createApartamentos($data, $id)
    {
        //CADASTRO BLOCOS
        $nomemclature = $this->blockNomemclatureRepository->find($data['block_nomemclature_id']);
        $unitType = $this->unitTypeRepository->find($data['unit_type_id']);
        $labelUnitType = $unitType['label'] . " ";

        $legenda = substr($nomemclature['label'], 0, -1);
        $multiplicador = strlen($data['number_init']);

        if ($nomemclature['type'] == 'l') {
            $contBlock = 'A';
        } else {
            $contBlock = 1;
        }

        for ($i = 1; $i <= $data['qtde_block']; $i++) {

            //cadastrei o bloco
            if ($nomemclature['type'] == 'l') {
                $block['name'] = $legenda . ' ' . $contBlock;
            } else {
                $block['name'] = $legenda . ' ' . $contBlock;
            }

            $block['condominium_id'] = $id;
            $dadosBlock = $this->blockRepository->create($block);
            if ($dadosBlock) {
                $numeroInit = $data['number_init'];
                for ($andar = 1; $andar <= $data['unidade_andar']; $andar++) {
                    for ($unidade = 1; $unidade <= $data['number_andar']; $unidade++) {

                        $nomeAP = '';
                        if ($multiplicador == 1) {
                            if ($andar == 1 && $unidade == 1) {
                                $nomeAP = $data['number_init'];
                            } else {
                                $nomeAP = $numeroInit + 1;
                            }
                        } else {
                            if ($andar == 1 && $unidade == 1) {
                                $nomeAP = $numeroInit;
                            } else {
                                if ($andar > 1 && $unidade == 1) {
                                    $numeroInit = ($data['number_init'] * $andar) - ($andar - 1);
                                    $nomeAP = $numeroInit;
                                } else {
                                    $nomeAP = $numeroInit + 1;
                                }
                            }
                        }

                        $numeroInit = $nomeAP;
                        $unit['name'] = $labelUnitType . $nomeAP;
                        $unit['floor'] = $andar;
                        $unit['block_id'] = $dadosBlock['id'];
                        $unit['unit_type_id'] = $data['unit_type_id'];
                        $unit['condominium_id'] = $id;

                        $dadosUnit = $this->unitRepository->create($unit);
                        if ($dadosUnit) {
                        }

                    }
                }
            }

            $contBlock++;
        }

        return true;
    }

    public function createGaragem($data, $id)
    {
        $unitType = $this->unitTypeRepository->find($data['unit_type_id']);

        //CADASTRA BLOCO GARAGEM
        $block['name'] = 'Garagem';
        $block['condominium_id'] = $id;
        $dadosBlock = $this->blockRepository->create($block);

        if ($dadosBlock) {
            for ($garagem = 1; $garagem <= $data['number_garagem']; $garagem++) {
                $unit['name'] = $unitType['label'] . ' ' . $garagem;
                $unit['block_id'] = $dadosBlock['id'];
                $unit['unit_type_id'] = $data['unit_type_id'];
                $unit['condominium_id'] = $id;

                $dadosUnit = $this->unitRepository->create($unit);
                if ($dadosUnit) {
                }
            }
        }

        return true;
    }

    public function createCasa($data, $id)
    {
        //CADASTRO BLOCOS
        $nomemclature = $this->blockNomemclatureRepository->find($data['block_nomemclature_id']);
        $unitType = $this->unitTypeRepository->find($data['unit_type_id']);
        $labelUnitType = $unitType['label'] . " ";

        $legenda = substr($nomemclature['label'], 0, -1);

        if ($nomemclature['type'] == 'l') {
            $contBlock = 'A';
        } else {
            $contBlock = 1;
        }

        for ($i = 1; $i <= $data['qtde_block']; $i++) {

            //cadastrei o bloco
            if ($nomemclature['type'] == 'l') {
                $block['name'] = $legenda . ' ' . $contBlock;
            } else {
                $block['name'] = $legenda . ' ' . $contBlock;
            }

            $block['condominium_id'] = $id;
            $dadosBlock = $this->blockRepository->create($block);
            if ($dadosBlock) {
                $numeroInit = $data['casa_ini'];
                for ($casa = $data['casa_ini']; $casa <= $data['casa_fim']; $casa++) {
                    $nomeAP = '';

                    if ($casa == $data['casa_ini']) {
                        $nomeAP = $data['casa_ini'];
                    } else {
                        $nomeAP = $numeroInit + 1;
                    }

                    $numeroInit = $nomeAP;
                    $unit['name'] = $labelUnitType . $nomeAP;
                    $unit['block_id'] = $dadosBlock['id'];
                    $unit['unit_type_id'] = $data['unit_type_id'];
                    $unit['condominium_id'] = $id;

                    $dadosUnit = $this->unitRepository->create($unit);
                    if ($dadosUnit) {
                    }

                }
            }

            $contBlock++;
        }

        return true;

    }

    public function clearUnitBlock($condominiumId)
    {

        $unit = $this->unitRepository->findWhere(['condominium_id' => $condominiumId]);
        if ($unit) {
            foreach ($unit as $row) {
                $this->unitRepository->delete($row->id);
            }
        }

        $block = $this->blockRepository->findWhere(['condominium_id' => $condominiumId]);
        if ($block) {
            foreach ($block as $row) {
                $this->blockRepository->delete($row->id);
            }
        }

        return true;
    }

    public function clearUsersCondominium($condominiumId, $userId)
    {
        if (isset($condominiumId)) {
            $users = $this->usersCondominiumRepository->findWhere([
                'condominium_id' => $condominiumId,
                'user_id' => $userId
            ]);

            if ($users->toArray()) {
                foreach ($users as $row) {
                    $this->usersCondominiumService->destroy($row->id);
                }
            }

            return true;
        }

        return false;
    }

}