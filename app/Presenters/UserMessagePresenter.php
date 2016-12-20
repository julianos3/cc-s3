<?php

namespace CentralCondo\Presenters;

use CentralCondo\Transformers\UserMessageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UserMessagePresenter
 *
 * @package namespace CentralCondo\Presenters;
 */
class UserMessagePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserMessageTransformer();
    }
}
