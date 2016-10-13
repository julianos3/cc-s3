<?php

namespace CentralCondo\Repositories\Portal\Manage;

use CentralCondo\Entities\Portal\Manage\Periodicity;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Manage\PeriodicityRepository;
use CentralCondo\Validators\Portal\Manage\ReserveAreasValidator;

/**
 * Class PeriodicityRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal\Manage;
 */
class PeriodicityRepositoryEloquent extends BaseRepository implements PeriodicityRepository
{

    public function listPeriodicity()
    {
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Periodicity::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
