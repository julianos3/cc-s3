<?php

namespace CentralCondo\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'CentralCondo\Model' => 'CentralCondo\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //$this->levelAdm($gate);
        //
    }

    public function levelAdm($gate)
    {
        $user_role_condominium = session()->get('user_role_condominium');
        dd($user_role_condominium);
        $gate->define('delete-called', function($user_role_condominium){
            if($user_role_condominium == 1 || $user_role_condominium == 2 ||
                $user_role_condominium == 3  || $user_role_condominium == 7 ||
                $user_role_condominium == 9){
                dd('aa');
            }else{
                dd('aaaa');
            }
            //html @can
        });
    }

}
