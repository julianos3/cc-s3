<?php

namespace CentralCondo\Repositories\Portal\Condominium\Provider;

use CentralCondo\Entities\Portal\Condominium\Provider\Providers;
use CentralCondo\Validators\Portal\Condominium\Provider\ProvidersValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ProvidersRepositoryEloquent
 * @package CentralCondo\Repositories\Portal\Condominium\Provider
 */
class ProvidersRepositoryEloquent extends BaseRepository implements ProvidersRepository
{

    public function listCondominium($condominiumId)
    {
        $dados = $this->findWhere([
            'condominium_id' => $condominiumId,
            'active' => 'y'
        ]);

        return $dados;
    }

    public function listCondominiumAll($condominiumId)
    {
        $dados = $this->findWhere([
            'condominium_id' => $condominiumId
        ]);

        return $dados;
    }

    public function listProviders()
    {
        return $this->model->lists('name', 'id');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Providers::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ProvidersValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
