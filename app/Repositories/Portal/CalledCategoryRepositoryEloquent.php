<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\CalledCategoryRepository;
use CentralCondo\Entities\Portal\CalledCategory;
use CentralCondo\Validators\Portal\CalledCategoryValidator;

/**
 * Class CalledCategoryRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class CalledCategoryRepositoryEloquent extends BaseRepository implements CalledCategoryRepository
{

    public function listCalledCategory(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CalledCategory::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CalledCategoryValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
