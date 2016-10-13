<?php

namespace CentralCondo\Presenters\Portal;

use CentralCondo\Transformers\Portal\UsersRolesCondominiumTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UsersRolesCondominiumPresenter
 *
 * @package namespace CentralCondo\Presenters;
 */
class UsersRolesCondominiumPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UsersRolesCondominiumTransformer();
    }
}
