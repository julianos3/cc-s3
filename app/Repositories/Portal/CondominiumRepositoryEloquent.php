<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\CondominiumRepository;
use CentralCondo\Entities\Portal\Condominium;
use CentralCondo\Validators\Portal\CondominiumValidator;

/**
 * Class CondominiumRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class CondominiumRepositoryEloquent extends BaseRepository implements CondominiumRepository
{

    protected $skipPresenter = true;

    public function listCondominium(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Condominium::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CondominiumValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
