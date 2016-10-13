<?php

namespace CentralCondo\Repositories\Portal;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\DiaryRepository;
use CentralCondo\Entities\Portal\Diary;
use CentralCondo\Validators\Portal\DiaryValidator;

/**
 * Class DiaryRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class DiaryRepositoryEloquent extends BaseRepository implements DiaryRepository
{

    public function getCondominiumId($diaryId)
    {;
        $dados = $this->model->find([
            'id' => $diaryId
        ]);
        return $dados[0]->condominium_id;
    }

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
