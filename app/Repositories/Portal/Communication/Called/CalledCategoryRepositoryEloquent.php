<?php

namespace CentralCondo\Repositories\Portal\Communication\Called;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Communication\Called\CalledCategoryRepository;
use CentralCondo\Entities\Portal\Communication\Called\CalledCategory;
use CentralCondo\Validators\Portal\Communication\Called\CalledCategoryValidator;

/**
 * Class CalledCategoryRepositoryEloquent
 * @package CentralCondo\Repositories\Portal\Communication\Called
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
