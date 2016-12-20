<?php

namespace CentralCondo\Repositories\Portal\Condominium\Diary;

use CentralCondo\Entities\Portal\Condominium\Diary\UsersDiary;
use CentralCondo\Validators\Portal\UsersDiaryValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Condominium\Diary\UsersDiaryRepository;

/**
 * Class UsersDiaryRepositoryEloquent
 * @package CentralCondo\Repositories\Portal\Condominium\Diary
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
