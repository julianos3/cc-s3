<?php

namespace CentralCondo\Repositories\Portal\Condominium;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Condominium\SecurityCamRepository;
use CentralCondo\Entities\Portal\Condominium\SecurityCam;
use CentralCondo\Validators\Portal\Condominium\SecurityCamValidator;

/**
 * Class SecurityCamRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class SecurityCamRepositoryEloquent extends BaseRepository implements SecurityCamRepository
{

    public function listSecurityCam(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SecurityCam::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SecurityCamValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
