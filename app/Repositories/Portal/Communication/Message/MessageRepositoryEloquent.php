<?php

namespace CentralCondo\Repositories\Portal\Communication\Message;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Communication\Message\MessageRepository;
use CentralCondo\Entities\Portal\Communication\Message\Message;
use CentralCondo\Validators\Portal\Communication\Message\MessageValidator;

/**
 * Class MessageRepositoryEloquent
 * @package CentralCondo\Repositories\Portal\Communication\Message
 */
class MessageRepositoryEloquent extends BaseRepository implements MessageRepository
{

    public function listMessage(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Message::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MessageValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
