<?php

namespace CentralCondo\Repositories\Portal;

use CentralCondo\Entities\Portal\UsersDiary;
use CentralCondo\Validators\Portal\UsersDiaryValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\UsersDiaryRepository;

/**
 * Class UsersDiaryRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class UsersDiaryRepositoryEloquent extends BaseRepository implements UsersDiaryRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UsersDiary::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UsersDiaryValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
