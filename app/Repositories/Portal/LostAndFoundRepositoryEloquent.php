<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\LostAndFoundRepository;
use CentralCondo\Entities\Portal\LostAndFound;
use CentralCondo\Validators\Portal\LostAndFoundValidator;

/**
 * Class LostAndFoundRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class LostAndFoundRepositoryEloquent extends BaseRepository implements LostAndFoundRepository
{

    public function listLostAndFound(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LostAndFound::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return LostAndFoundValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
