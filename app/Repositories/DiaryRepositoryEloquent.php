<?php

namespace CentralCondo\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\DiaryRepository;
use CentralCondo\Entities\Diary;
use CentralCondo\Validators\DiaryValidator;

/**
 * Class DiaryRepositoryEloquent
 * @package namespace CentralCondo\Repositories;
 */
class DiaryRepositoryEloquent extends BaseRepository implements DiaryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Diary::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DiaryValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
