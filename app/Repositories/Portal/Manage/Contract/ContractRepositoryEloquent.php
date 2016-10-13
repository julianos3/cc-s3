<?php

namespace CentralCondo\Repositories\Portal\Manage\Contract;

use CentralCondo\Entities\Portal\Manage\Contract\Contract;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Manage\Contract\ContractRepository;
use CentralCondo\Validators\Portal\Manage\Contract\ContractValidator;

/**
 * Class ReserveAreasRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal\Manage\Contract;
 */
class ContractRepositoryEloquent extends BaseRepository implements ContractRepository
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
        return Contract::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ContractValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
