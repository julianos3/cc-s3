<?php

namespace CentralCondo\Http\Controllers\Portal;

use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use Illuminate\Http\Request;

use CentralCondo\Http\Requests;
use CentralCondo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    protected $usersCondominiumRepository;

    public function __construct(UsersCondominiumRepository $usersCondominiumRepository)
    {
        $this->usersCondominiumRepository = $usersCondominiumRepository;
    }

    public function index()
    {
        $config['title'] = 'Home';

        //dd(Auth::user()->id);
        //verifica se existe condominio vinculado a este usuario
        $dados = $this->usersCondominiumRepository->findWhere([
            'user_id' => Auth::user()->id
        ]);

        //Event::fire(new SendMail(1));

        if (!$dados->isEmpty()) {
            return view('portal.home.index', compact('config'));
        } else {
            return redirect(route('portal.condominium.create'));
        }

    }

}
