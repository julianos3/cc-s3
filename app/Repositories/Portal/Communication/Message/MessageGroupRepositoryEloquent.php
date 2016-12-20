<?php

namespace CentralCondo\Repositories\Portal\Communication\Message;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Communication\Message\MessageGroupRepository;
use CentralCondo\Entities\Portal\Communication\Message\MessageGroup;
use CentralCondo\Validators\Portal\Communication\Message\MessageGroupValidator;

/**
 * Class MessageGroupRepositoryEloquent
 * @package CentralCondo\Repositories\Portal\Communication\Message
 */
class MessageGroupRepositoryEloquent extends BaseRepository implements MessageGroupRepository
{

    public function listMessageGroup(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MessageGroup::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MessageGroupValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
