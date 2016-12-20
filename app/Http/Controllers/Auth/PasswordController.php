<?php

namespace CentralCondo\Http\Controllers\Auth;

use Illuminate\Http\Request;
use CentralCondo\Http\Controllers\Controller;
use CentralCondo\Repositories\Portal\UserRepository;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * PasswordController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('guest');
    }


    public function postEmail(Request $request)
    {

        if(isset($_POST['email'])){

            $dados = $this->repository->findWhere(['email' => $_POST['email']]);
            if(isset($dados[0])){
                //dd($dados[0]);
                $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject('Link de recuperação de sua senha - Central Condo');
                });

                $response = 'Link para redefinição de senha foi enviado para seu e-mail';

                return redirect()->back()->with('status', trans($response));
            }else{
                $response = 'E-mail informado não encontrado';
            }
        }else{
            $response = 'E-mail não informado';
        }
        
        return redirect()->back()->withErrors($response)->withInput();

    }
}
