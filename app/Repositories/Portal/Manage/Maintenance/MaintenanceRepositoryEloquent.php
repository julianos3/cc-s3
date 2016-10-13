<?php

namespace CentralCondo\Repositories\Portal\Manage\Maintenance;

use CentralCondo\Entities\Portal\Manage\Maintenance\Maintenance;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Manage\Maintenance\MaintenanceRepository;
use CentralCondo\Validators\Portal\Manage\Maintenance\MaintenanceValidator;

/**
 * Class ReserveAreasRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal\Manage\Maintenance;
 */
class MaintenanceRepositoryEloquent extends BaseRepository implements MaintenanceRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Maintenance::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return MaintenanceValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
