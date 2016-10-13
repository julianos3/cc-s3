<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\LostAndFoundCompletedRepository;
use CentralCondo\Entities\Portal\LostAndFoundCompleted;
use CentralCondo\Validators\Portal\LostAndFoundCompletedValidator;

/**
 * Class LostAndFoundCompletedRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class LostAndFoundCompletedRepositoryEloquent extends BaseRepository implements LostAndFoundCompletedRepository
{

    public function listLostAndFoundCompleted(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LostAndFoundCompleted::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return LostAndFoundCompletedValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
