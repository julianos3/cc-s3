<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\CalledRepository;
use CentralCondo\Entities\Portal\Called;
use CentralCondo\Validators\Portal\CalledValidator;

/**
 * Class CalledRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class CalledRepositoryEloquent extends BaseRepository implements CalledRepository
{

    public function listCalled(){
        return $this->model->lists('name', 'id');
    }

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
