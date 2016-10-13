<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\CityRepository;
use CentralCondo\Entities\Portal\City;
use CentralCondo\Validators\Portal\CityValidator;

/**
 * Class CityRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class CityRepositoryEloquent extends BaseRepository implements CityRepository
{

    public function listCity(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return City::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CityValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
