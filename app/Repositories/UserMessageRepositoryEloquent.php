<?php

namespace CentralCondo\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\UserMessageRepository;
use CentralCondo\Entities\UserMessage;
use CentralCondo\Validators\UserMessageValidator;

/**
 * Class UserMessageRepositoryEloquent
 * @package namespace CentralCondo\Repositories;
 */
class UserMessageRepositoryEloquent extends BaseRepository implements UserMessageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserMessage::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UserMessageValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
