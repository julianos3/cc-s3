<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\CalledHistoricRepository;
use CentralCondo\Entities\Portal\CalledHistoric;
use CentralCondo\Validators\Portal\CalledHistoricValidator;

/**
 * Class CalledHistoricRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class CalledHistoricRepositoryEloquent extends BaseRepository implements CalledHistoricRepository
{

    public function listCalledHistoric(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CalledHistoric::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CalledHistoricValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
