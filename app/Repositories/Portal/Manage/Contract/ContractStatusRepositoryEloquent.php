<?php

namespace CentralCondo\Repositories\Portal\Manage\Contract;

use CentralCondo\Entities\Portal\Manage\Contract\ContractStatus;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Manage\Contract\ContractStatusRepository;
use CentralCondo\Validators\Portal\Manage\Contract\ContractStatusValidator;

/**
 * Class ReserveAreasRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal\Manage\Contract;
 */
class ContractStatusRepositoryEloquent extends BaseRepository implements ContractStatusRepository
{

    public function listContractStatus()
    {
        return $this->model->lists('title', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ContractStatus::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ContractStatusValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
