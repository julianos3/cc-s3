<?php

namespace CentralCondo\Repositories\Portal\Manage\ReserveAreas;

use CentralCondo\Entities\Portal\Manage\ReserveAreas\ReserveAreas;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Manage\ReserveAreas\ReserveAreasRepository;
use CentralCondo\Validators\Portal\Manage\ReserveAreas\ReserveAreasValidator;

/**
 * Class ReserveAreasRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal\Manage;
 */
class ReserveAreasRepositoryEloquent extends BaseRepository implements ReserveAreasRepository
{

    public function listReserveAreas()
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
        return ReserveAreas::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ReserveAreasValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
