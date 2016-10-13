<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\ForumResponseRepository;
use CentralCondo\Entities\Portal\ForumResponse;
use CentralCondo\Validators\Portal\ForumResponseValidator;

/**
 * Class ForumResponseRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class ForumResponseRepositoryEloquent extends BaseRepository implements ForumResponseRepository
{

    public function listForumResponse(){
        return $this->model->lists('description', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ForumResponse::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ForumResponseValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
