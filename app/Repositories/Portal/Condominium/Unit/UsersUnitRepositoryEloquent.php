<?php

namespace CentralCondo\Repositories\Portal\Condominium\Unit;

use CentralCondo\Entities\Portal\Condominium\Unit\UsersUnit;
use CentralCondo\Validators\Portal\Condominium\Unit\UsersUnitValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Condominium\Unit\UsersUnitRepository;

/**
 * Class UsersUnitRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class UsersUnitRepositoryEloquent extends BaseRepository implements UsersUnitRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UsersUnit::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UsersUnitValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
