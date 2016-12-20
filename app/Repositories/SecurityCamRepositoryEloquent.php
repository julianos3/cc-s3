<?php

namespace CentralCondo\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\SecurityCamRepository;
use CentralCondo\Entities\SecurityCam;
use CentralCondo\Validators\SecurityCamValidator;

/**
 * Class SecurityCamRepositoryEloquent
 * @package namespace CentralCondo\Repositories;
 */
class SecurityCamRepositoryEloquent extends BaseRepository implements SecurityCamRepository
{
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
