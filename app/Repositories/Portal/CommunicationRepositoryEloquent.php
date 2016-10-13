<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\CommunicationRepository;
use CentralCondo\Entities\Portal\Communication;
use CentralCondo\Validators\Portal\CommunicationValidator;

/**
 * Class CommunicationRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
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
