<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\CalledStatusRepository;
use CentralCondo\Entities\Portal\CalledStatus;
use CentralCondo\Validators\Portal\CalledStatusValidator;

/**
 * Class CalledStatusRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class CalledStatusRepositoryEloquent extends BaseRepository implements CalledStatusRepository
{

    public function listCalledStatus(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CalledStatus::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CalledStatusValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
