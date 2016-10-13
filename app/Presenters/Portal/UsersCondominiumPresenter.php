<?php

namespace CentralCondo\Presenters\Portal;

use CentralCondo\Transformers\Portal\UsersCondominiumTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UsersCondominiumPresenter
 *
 * @package namespace CentralCondo\Presenters;
 */
class UsersCondominiumPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UsersCondominiumTransformer();
    }
}
