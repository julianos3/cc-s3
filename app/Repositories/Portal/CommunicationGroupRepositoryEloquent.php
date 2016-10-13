<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\CommunicationGroupRepository;
use CentralCondo\Entities\Portal\CommunicationGroup;
use CentralCondo\Validators\Portal\CommunicationGroupValidator;

/**
 * Class CommunicationGroupRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class CommunicationGroupRepositoryEloquent extends BaseRepository implements CommunicationGroupRepository
{

    public function listCommunicationGroup(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CommunicationGroup::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CommunicationGroupValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
