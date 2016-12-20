<?php

namespace CentralCondo\Presenters;

use CentralCondo\Transformers\SecurityCamTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SecurityCamPresenter
 *
 * @package namespace CentralCondo\Presenters;
 */
class SecurityCamPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SecurityCamTransformer();
    }
}
