<?php

namespace CentralCondo\Repositories\Portal\Manage\Maintenance;

use CentralCondo\Entities\Portal\Manage\Maintenance\MaintenanceCompleted;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Manage\Maintenance\MaintenanceCompletedRepository;
use CentralCondo\Validators\Portal\Manage\Maintenance\MaintenanceCompletedValidator;

/**
 * Class MaintenanceCompletedRepositoryEloquent
 * @package CentralCondo\Repositories\Portal\Manage\Maintenance
 */
class MaintenanceCompletedRepositoryEloquent extends BaseRepository implements MaintenanceCompletedRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MaintenanceCompleted::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return MaintenanceCompletedValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
