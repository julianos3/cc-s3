<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\UsersRoleRepository;
use CentralCondo\Entities\Portal\UsersRole;
use CentralCondo\Validators\Portal\UsersRoleValidator;

/**
 * Class UsersRoleRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class UsersRoleRepositoryEloquent extends BaseRepository implements UsersRoleRepository
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
        return UsersRole::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UsersRoleValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
