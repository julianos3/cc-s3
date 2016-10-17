<?php

namespace CentralCondo\Services\Portal;

use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Repositories\Portal\UserRepository;
use CentralCondo\Validators\Portal\UserValidator;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserService
{

    protected $repository;

    protected $validator;

    protected $usersCondominiumRepository;

    protected $filesystem;

    protected $storage;

    public function __construct(UserRepository $repository,
                                UserValidator $validator,
                                UsersCondominiumRepository $usersCondominiumRepository,
                                Filesystem $filesystem,
                                Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
        $this->condominium_id = session()->get('condominium_id');
        $this->path = 'user/' . session()->get('user_id') . '/';
    }

    public function create(array $data)
    {
        try {
            if (!isset($data['user_role_id'])) {
                $data['user_role_id'] = 1;
            }

            //$data['password'] = $data['password'];
            $data['password_confirmed'] = $data['password_confirmation'];

            if ($this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE)) {
                /*
                */
                //dd($data);
                //Hash::make(Input::get('password'));
                $data['password'] = bcrypt($data['password']);
                $data['password_confirmation'] = bcrypt($data['password_confirmation']);
                $dados = $this->repository->createUser($data);

                if ($dados) {
                    //cria o auth do usuário cadastrado
                    Auth::login($dados);

                    //enviar e-mail

                    //cria session do id do condominio
                    $this->userSessionCondominion();

                    //redireciona
                    return redirect(route('portal.condominium.create'));
                }
            }

        } catch (ValidatorException $e) {
            $response = trans("Erro ao cadastrar usuário");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function update(array $data, $id)
    {
        try {
            $path = 'user/' . $id . '/';
            $image = $this->getFileName($id);

            //verifica se trocou a imagem
            if (empty($data['imagem'])) {
                $data['imagem'] = $image;
                $deleteImage = false;
            } else {
                $nameImage = md5(date('ymdsmdys'));
                $extension = $data['imagem']->getClientOriginalExtension();

                $this->storage->put($path . $nameImage, $this->filesystem->get($data['imagem']));
                $data['imagem'] = $nameImage . '.' . $extension;
                $deleteImage = true;
            }

            //formata data de nascimento
            if (isset($data['birth'])) {
                $data['birth'] = date("Y-m-d", strtotime(str_replace('/', '-', $data['birth'])));
            }

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $dados = $this->repository->update($data, $id);

            if ($dados) {

                if ($deleteImage && !isset($image)) {
                    $image = explode('.', $image);
                    if ($this->storage->exists($path . $image[0])) {
                        $this->storage->delete($path . $image[0]);
                    }
                }

                //altera imagem na session se for do proprio usuario
                if(Auth::user()->id == $id){
                    $this->userSessionCondominion();
                }

                $response = trans("Integrante alterado com sucesso!");
                return redirect()->back()->with('status', trans($response));
            }
        } catch (ValidatorException $e) {
            $response = trans("Erro ao alterar o integrante");
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function userSessionCondominion()
    {

        //verifica se usuario possui mais de um condominio vinculado
        //se possui mais de um irá para um tela de escolha de condominio
        //se possui 1 irá salvar na session o id do condominio
        //se não possui nenhum condominio vai para a tela de cadastro de condominio

        $usersCondominium = $this->usersCondominiumRepository->findWhere([
            'user_id' => Auth::user()->id
        ]);

        if (count($usersCondominium) > 1) {
            //multiplos condominios
            //salva todos os condominios na session
        } elseif (count($usersCondominium) == 1) {

            $usersCondominium = $usersCondominium[0];
            if ($this->storage->exists($this->path . $usersCondominium->user->image)) {
                $image = $usersCondominium->user->imagem;
            } else {
                $image = 'avatar.jpg';
            }

            session([
                'user_id' => $usersCondominium->user->id,
                'user_condominium_id' => $usersCondominium->id,
                'user_role_condominium' => $usersCondominium->user_role_condominium,
                'condominium_id' => $usersCondominium->condominium_id,
                'name' => $usersCondominium->condominium->name,
                'image' => route('portal.condominium.user.image', [
                    'id' => Auth::user()->id,
                    'image' => $image
                ]),
            ]);
        }

        return true;
    }

    public function getFilePath($id)
    {
        $user = $this->repository->skipPresenter()->find($id);
        return $this->getBaseURL($user);
    }

    public function getFileName($id)
    {
        $user = $this->repository->skipPresenter()->find($id);
        return $user['imagem'];
    }

    public function getBaseURL($user)
    {
        switch ($this->storage->getDefaultDriver()) {
            case 'local':
                return $this->storage->getDriver()->getAdapter()->getPathPrefix()
                . '/' . $this->getFileName($user['id']);
        }
    }

}