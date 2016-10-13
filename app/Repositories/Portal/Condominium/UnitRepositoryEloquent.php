<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\UnitRepository;
use CentralCondo\Entities\Portal\Unit;
use CentralCondo\Validators\Portal\UnitValidator;

/**
 * Class UnitRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class UnitRepositoryEloquent extends BaseRepository implements UnitRepository
{

    public function listUnit(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Unit::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UnitValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
