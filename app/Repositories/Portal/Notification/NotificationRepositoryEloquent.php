<?php

namespace CentralCondo\Repositories\Portal\Notification;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Notification\NotificationRepository;
use CentralCondo\Entities\Portal\Notification\Notification;
use CentralCondo\Validators\Portal\Notification\NotificationValidator;

/**
 * Class NotificationRepositoryEloquent
 * @package CentralCondo\Repositories\Portal\Notification
 */
class NotificationRepositoryEloquent extends BaseRepository implements NotificationRepository
{

    public function listCity(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Notification::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return NotificationValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
