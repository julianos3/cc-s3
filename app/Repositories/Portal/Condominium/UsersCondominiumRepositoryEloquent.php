<?php

namespace CentralCondo\Repositories\Portal\Condominium;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use CentralCondo\Validators\Portal\Condominium\UsersCondominiumValidator;

/**
 * Class UsersCondominiumRepositoryEloquent
 * @package namespace CentralCondo\Repositories;
 */
class UsersCondominiumRepositoryEloquent extends BaseRepository implements UsersCondominiumRepository
{

    public function listUsersCondominium()
    {
        return $this->model->lists('user_id', 'id');
    }

    public function listUsersCondominiumFind($condominiumId)
    {
        return $this->skipPresenter()->findWhere([
            'condominium_id' => $condominiumId
        ]);
    }

    public function verificaAdm($userRoleCondominium)
    {
        if(isset($userRoleCondominium)){
            if($userRoleCondominium == 1 || $userRoleCondominium == 2 || $userRoleCondominium == 3
            || $userRoleCondominium == 7 || $userRoleCondominium == 9){
                return true;
            }
        }

        return false;
    }

    public function getAdm($condominiumId)
    {
        $dados = $this->scopeQuery(function($query) use ($condominiumId){
            return $query->where('condominium_id', $condominiumId)
                ->where('user_role_condominium', 1)
                ->orWhere('user_role_condominium', 2)
                ->orWhere('user_role_condominium', 3)
                ->orWhere('user_role_condominium', 7)
                ->orWhere('user_role_condominium', 9);
        })->all();

        if($dados->toArray()){
            return $dados;
        }

        return false;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UsersCondominium::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return UsersCondominiumValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
