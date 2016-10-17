<?php

namespace CentralCondo\Repositories\Portal\Communication\Called;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Communication\Called\CalledRepository;
use CentralCondo\Entities\Portal\Communication\Called\Called;
use CentralCondo\Validators\Portal\Communication\Called\CalledValidator;

/**
 * Class CalledRepositoryEloquent
 * @package CentralCondo\Repositories\Portal\Communication\Called
 */
class CalledRepositoryEloquent extends BaseRepository implements CalledRepository
{
    

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Called::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CalledValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
