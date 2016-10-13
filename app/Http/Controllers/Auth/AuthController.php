<?php

namespace CentralCondo\Http\Controllers\Auth;

use CentralCondo\Entities\Portal\User;
use CentralCondo\Repositories\Portal\UserRepository;
use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Services\Portal\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use CentralCondo\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    protected $redirectPath = '/portal/home';

    protected $loginPath = '/portal/auth/login';

    protected $usersCondominiumRepository;

    /**
     * @var UserRepository
     */
    protected $repository;
    /**
     * @var UserService
     */
    protected $service;

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * AuthController constructor.
     * @param UserRepository $repository
     * @param UserService $service
     * @param UsersCondominiumRepository $usersCondominiumRepository
     */
    public function __construct(UserRepository $repository,
                                UserService $service,
                                UsersCondominiumRepository $usersCondominiumRepository)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->usersCondominiumRepository = $usersCondominiumRepository;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function postLogin(ValidatorException $e)
    {

        $user = array(
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'active' => 'y'
        );

        if (Auth::attempt($user)) {
            
            $this->service->userSessionCondominion();

            return redirect(route('portal.home.index'));
        }

        $response = 'Usuário e/ou senha inválidos';
        return redirect()->back()->withErrors($response)->withInput();
    }

    public function postRegister(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function getLogout()
    {
        session()->flush();
        Auth::logout();

        return redirect(route('auth.login'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
