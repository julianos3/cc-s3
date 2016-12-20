<?php

namespace CentralCondo\Presenters;

use CentralCondo\Transformers\DiaryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DiaryPresenter
 *
 * @package namespace CentralCondo\Presenters;
 */
class DiaryPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DiaryTransformer();
    }
}
