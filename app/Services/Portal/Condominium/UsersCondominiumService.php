<?php

namespace CentralCondo\Services\Portal\Condominium;

use CentralCondo\Repositories\Portal\Condominium\Unit\UsersUnitRepository;
use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Repositories\Portal\UserRepository;
use CentralCondo\Services\Portal\Condominium\Unit\UsersUnitService;
use CentralCondo\Services\Portal\UserService;
use CentralCondo\Validators\Portal\Condominium\UsersCondominiumValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class UsersCondominiumService //regras de negocios
{

    protected $repository;

    protected $validator;

    protected $userRepository;

    protected $usersUnitRepository;

    protected $usersUnitService;

    protected $userService;

    public function __construct(UsersCondominiumRepository $repository,
                                UsersCondominiumValidator $validator,
                                UserRepository $userRepository,
                                UsersUnitRepository $usersUnitRepository,
                                UsersUnitService $usersUnitService,
                                UserService $userService)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->userRepository = $userRepository;
        $this->usersUnitRepository = $usersUnitRepository;
        $this->usersUnitService = $usersUnitService;
        $this->userService = $userService;
        $this->condominium_id = session()->get('condominium_id');
    }

    public function create(array $data)
    {

        $verifica = $this->repository->findWhere([
            'user_id' => $data['user_id'],
            'condominium_id' => $data['condominium_id']
        ]);

        if ($verifica->toArray()) {
            $response = trans("Usuário já cadastrado neste condominio");
            return redirect()->back()->withErrors($response)->withInput();
        } else {
            try {

                $this->validator->with($data)->passesOrFail();
                $dados = $this->repository->create($data);

                if ($dados) {
                    $response = trans("Integrante cadastrado com sucesso!");
                    return redirect()->back()->with('status', trans($response));
                }

            } catch (ValidatorException $e) {
                $response = trans("Erro ao cadastrar o integrante");
                return redirect()->back()->withErrors($response)->withInput();
            }
        }
    }

    public function update(array $data, $id)
    {
        $usersCondominium = $this->repository->findWhere(['user_id' => $id]);
        if($usersCondominium->toArray()){
            return $this->userService->update($data, $usersCondominium[0]->user_id);
        }else{

        }
        /*
        dd($usersCondominium);
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $dados = $this->repository->update($data, $id);

            if ($dados) {
                $response = [
                    'message' => 'User updated.',
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
        */

    }

    public function destroy($id)
    {
        //verifica se existe unidades vinculadas ao usuário
        $usersUnit = '';
        $usersUnit = $this->usersUnitRepository->findWhere([
            'user_condominium_id' => $id
        ]);

        if($usersUnit->toArray()){
            $response = trans("Erro ao excluir o integrante do condomínio, existem unidades vinculadas.");
            return redirect()->back()->withErrors($response)->withInput();
        }else {
            $deleted = $this->repository->delete($id);
            if ($deleted) {
                $response = trans("Integrante do condomínio excluido com sucesso!");
                return redirect()->back()->with('status', trans($response));
            } else {
                $response = trans("Erro ao excluir o integrante do condomínio");
                return redirect()->back()->withErrors($response)->withInput();
            }
        }
    }

    public function createUserCondominium($data)
    {
        $user = '';
        if (isset($data['email'])) {
            $user = $this->userRepository->findWhere([
                //Default Condition =
                'email' => $data['email']
            ]);
        }

        //verifica se usuario encontrado já esta vinculado a este condominio
        $verificaCondominium = array();
        if (!isset($user)) {
            $verificaCondominium = $this->repository->findWhere([
                'user_id' => $user[0]->id,
                'user_condominium_id' => $this->condominium_id
            ]);
        }

        if (!isset($verificaCondominium)) {
            $response = trans("Usuário já cadastrado neste condominio");
            return redirect()->back()->withErrors($response)->withInput();
        } else {
            try {
                // dd($data);
                //cadastra usuario e envia e-mail com os acessos ao sistema
                //gerar uma senha automatica
                $data['user_role_id'] = 1;
                $data['password'] = $this->generatePassword();
                $data['password_confirmed'] = $data['password'];

                $data['password'] = bcrypt($data['password']);
                $data['password_confirmation'] = bcrypt($data['password_confirmed']);
                $user = $this->userRepository->createUser($data);

                //cadastra usuario no condominio
                $data['condominium_id'] = $this->condominium_id;
                $data['user_id'] = $user['id'];

                if ($data['user_unit_role'] == 1) {
                    $data['user_role_condominium'] = 4;
                } elseif ($data['user_unit_role'] == 2) {
                    $data['user_role_condominium'] = 8;
                } elseif ($data['user_unit_role'] == 3) {
                    $data['user_role_condominium'] = 6;
                } elseif ($data['user_unit_role'] == 4) {
                    $data['user_role_condominium'] = 5;
                } elseif ($data['user_unit_role'] == 5) {
                    $data['user_role_condominium'] = 10;
                }

                $this->validator->with($data)->passesOrFail();
                $dados = $this->repository->create($data);

                if ($dados) {

                    //cadastra users_unit
                    if (isset($dados['id']) && isset($data['unit_id']) && isset($data['user_unit_role'])) {
                        $usersUnit['user_condominium_id'] = $dados['id'];
                        $usersUnit['unit_id'] = $data['unit_id'];
                        $usersUnit['user_unit_role'] = $data['user_unit_role'];

                        $this->usersUnitRepository->create($usersUnit);
                    }


                    $response = trans("Integrante cadastrado com sucesso!");
                    return redirect()->back()->with('status', trans($response));
                }

            } catch (ValidatorException $e) {
                $response = trans("Erro ao cadastrar o integrante");
                return redirect()->back()->withErrors($response)->withInput();
            }
        }
    }


    public function generatePassword($tamanho = 6, $maiusculas = true, $numeros = true, $simbolos = false)
    {
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';
        $caracteres .= $lmin;
        if ($maiusculas) $caracteres .= $lmai;
        if ($numeros) $caracteres .= $num;
        if ($simbolos) $caracteres .= $simb;
        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }

        return $retorno;
    }

    public function userUnitCreate(array $data)
    {
        //verifica se unidade já esta vinculada a este usuario do condominio
        $verifica = '';                      
        $verifica = $this->usersUnitRepository->findWhere([
            'user_condominium_id' => $data['user_condominium_id'],
            'unit_id' => $data['unit_id']
        ]);

        if ($verifica->toArray()) {
            $response = trans('Unidade já vinculada ao integrante');
            return redirect()->back()->withErrors($response)->withInput();
        } else {
            return $this->usersUnitService->create($data);
        }
    }

}