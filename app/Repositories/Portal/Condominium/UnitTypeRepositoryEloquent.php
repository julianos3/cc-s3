<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\UnitTypeRepository;
use CentralCondo\Entities\Portal\UnitType;
use CentralCondo\Validators\Portal\UnitTypeValidator;

/**
 * Class CondominiumRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class UnitTypeRepositoryEloquent extends BaseRepository implements UnitTypeRepository
{

    protected $skipPresenter = true;

    public function listUnitType(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UnitType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UnitTypeValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
