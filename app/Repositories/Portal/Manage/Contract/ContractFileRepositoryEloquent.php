<?php

namespace CentralCondo\Repositories\Portal\Manage\Contract;

use CentralCondo\Entities\Portal\Manage\Contract\ContractFile;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Manage\Contract\ContractFileRepository;
use CentralCondo\Validators\Portal\Manage\Contract\ContractFileValidator;

/**
 * Class ReserveAreasRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal\Manage\Contract;
 */
class ContractFileRepositoryEloquent extends BaseRepository implements ContractFileRepository
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
        return ContractFile::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ContractFileValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
