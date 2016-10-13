<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\UsefulPhonesRepository;
use CentralCondo\Entities\Portal\UsefulPhones;
use CentralCondo\Validators\Portal\UsefulPhonesValidator;

/**
 * Class UsefulPhonesRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class UsefulPhonesRepositoryEloquent extends BaseRepository implements UsefulPhonesRepository
{

    public function listUsefulPhones(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UsefulPhones::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UsefulPhonesValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
