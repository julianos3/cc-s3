<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\FinalityRepository;
use CentralCondo\Entities\Portal\Finality;
use CentralCondo\Validators\Portal\FinalityValidator;

/**
 * Class UsersRoleRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class FinalityRepositoryEloquent extends BaseRepository implements FinalityRepository
{

    public function listFinality(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Finality::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FinalityValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
