<?php

namespace CentralCondo\Repositories\Portal\Condominium\Group;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Condominium\Group\UsersGroupCondominiumRepository;
use CentralCondo\Entities\Portal\Condominium\Group\UsersGroupCondominium;
use CentralCondo\Validators\Portal\Condominium\Group\UsersGroupCondominiumValidator;

/**
 * Class UsersGroupCondominiumRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class UsersGroupCondominiumRepositoryEloquent extends BaseRepository implements UsersGroupCondominiumRepository
{

    public function listUsersGroupCondominium(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UsersGroupCondominium::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UsersGroupCondominiumValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
