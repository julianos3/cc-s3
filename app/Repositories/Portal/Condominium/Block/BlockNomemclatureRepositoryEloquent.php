<?php

namespace CentralCondo\Repositories\Portal\Condominium\Block;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Condominium\Block\BlockNomemclatureRepository;
use CentralCondo\Entities\Portal\Condominium\Block\BlockNomemclature;
use CentralCondo\Validators\Portal\Condominium\Block\BlockNomemclatureValidator;

/**
 * Class BlockNomemclatureRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class BlockNomemclatureRepositoryEloquent extends BaseRepository implements BlockNomemclatureRepository
{

    protected $skipPresenter = true;

    public function listBlockNomemclature(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BlockNomemclature::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BlockNomemclatureValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
