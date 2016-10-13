<?php

namespace CentralCondo\Repositories\Portal\Condominium\Block;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CentralCondo\Repositories\Portal\Condominium\Block\BlockRepository;
use CentralCondo\Entities\Portal\Condominium\Block\Block;
use CentralCondo\Validators\Portal\Condominium\Block\BlockValidator;

/**
 * Class BlockRepositoryEloquent
 * @package namespace CentralCondo\Repositories\Portal;
 */
class BlockRepositoryEloquent extends BaseRepository implements BlockRepository
{

    public function listBlock(){
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Block::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BlockValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
