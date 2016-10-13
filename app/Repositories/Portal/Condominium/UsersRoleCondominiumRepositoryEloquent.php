<?php

namespace CentralCondo\Repositories\Portal\Condominium;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Condominium\UsersRoleCondominiumRepository;
use CentralCondo\Entities\Portal\Condominium\UsersRoleCondominium;
use CentralCondo\Validators\Portal\Condominium\UsersRoleCondominiumValidator;

/**
 * Class UsersRolesCondominiumRepositoryEloquent
 * @package namespace CentralCondo\Repositories;
 */
class UsersRoleCondominiumRepositoryEloquent extends BaseRepository implements UsersRoleCondominiumRepository
{

    public function listRole(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UsersRoleCondominium::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return UsersRoleCondominiumValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
