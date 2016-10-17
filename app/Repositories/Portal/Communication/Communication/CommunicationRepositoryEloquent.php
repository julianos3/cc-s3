<?php

namespace CentralCondo\Repositories\Portal\Communication\Communication;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Communication\Communication\CommunicationRepository;
use CentralCondo\Entities\Portal\Communication\Communication\Communication;
use CentralCondo\Validators\Portal\Communication\Communication\CommunicationValidator;

/**
 * Class CommunicationRepositoryEloquent
 * @package CentralCondo\Repositories\Portal\Communication\Communication
 */
class CommunicationRepositoryEloquent extends BaseRepository implements CommunicationRepository
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
        return Communication::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CommunicationValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
