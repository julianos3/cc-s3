<?php

namespace CentralCondo\Repositories\Portal\Condominium\Unit;

use CentralCondo\Entities\Portal\Condominium\Unit\UsersUnitRole;
use CentralCondo\Validators\Portal\Condominium\Unit\UsersUnitRoleValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UsersUnitRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class UsersUnitRoleRepositoryEloquent extends BaseRepository implements UsersUnitRoleRepository
{

    public function listUsersUnitRole(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UsersUnitRole::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UsersUnitRoleValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
