<?php

namespace CentralCondo\Repositories\Portal\Condominium;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Condominium\UsersCondominiumRepository;
use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use CentralCondo\Validators\Portal\Condominium\UsersCondominiumValidator;

/**
 * Class UsersCondominiumRepositoryEloquent
 * @package namespace CentralCondo\Repositories;
 */
class UsersCondominiumRepositoryEloquent extends BaseRepository implements UsersCondominiumRepository
{

    public function listUsersCondominium()
    {
        return $this->model->lists('user_id', 'id');
    }

    public function listUsersCondominiumFind($condominiumId)
    {
        return $this->skipPresenter()->findWhere([
            'condominium_id' => $condominiumId
        ]);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UsersCondominium::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return UsersCondominiumValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
