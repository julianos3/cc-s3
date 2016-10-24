<?php

namespace CentralCondo\Repositories\Portal\Communication\Communication;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Communication\Communication\UsersCommunicationRepository;
use CentralCondo\Entities\Portal\Communication\Communication\UsersCommunication;
use CentralCondo\Validators\Portal\Communication\Communication\UsersCommunicationValidator;

/**
 * Class UsersCommunicationRepositoryEloquent
 * @package CentralCondo\Repositories\Portal\Communication\Communication
 */
class UsersCommunicationRepositoryEloquent extends BaseRepository implements UsersCommunicationRepository
{

    public function listCommunication(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UsersCommunication::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UsersCommunicationValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
