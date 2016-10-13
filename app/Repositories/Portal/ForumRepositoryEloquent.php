<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\ForumRepository;
use CentralCondo\Entities\Portal\Forum;
use CentralCondo\Validators\Portal\ForumValidator;

/**
 * Class ForumRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class ForumRepositoryEloquent extends BaseRepository implements ForumRepository
{

    public function listForum(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Forum::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ForumValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
