<?php

namespace CentralCondo\Repositories\Portal\Condominium\Group;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Condominium\Group\GroupCondominiumRepository;
use CentralCondo\Entities\Portal\Condominium\Group\GroupCondominium;
use CentralCondo\Validators\Portal\Condominium\Group\GroupCondominiumValidator;

/**
 * Class GroupCondominiumRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class GroupCondominiumRepositoryEloquent extends BaseRepository implements GroupCondominiumRepository
{

    public function listGroupCondominium(){
        return $this->model->lists('name', 'id');
    }

    public function getCondominiumId($groupId)
    {
        $dados = $this->model->find([
            'id' => $groupId
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
        return GroupCondominium::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return GroupCondominiumValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
