<?php

namespace CentralCondo\Repositories\Portal\Communication\Message;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Communication\Message\UsersMessageRepository;
use CentralCondo\Entities\Portal\Communication\Message\UsersMessage;
use CentralCondo\Validators\Portal\Communication\Message\UsersMessageValidator;

/**
 * Class UsersMessageRepositoryEloquent
 * @package CentralCondo\Repositories\Portal\Communication\Message
 */
class UsersMessageRepositoryEloquent extends BaseRepository implements UsersMessageRepository
{

    public function listUsersMessage(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UsersMessage::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UsersMessageValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
