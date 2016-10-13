<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\UserRepository;
use CentralCondo\Entities\Portal\User;
use CentralCondo\Validators\Portal\UserValidator;
use Prettus\Repository\Events\RepositoryEntityCreated;

/**
 * Class UsersCondominiumRepositoryEloquent
 * @package namespace CentralCondo\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function listUser(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return UserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    

}
