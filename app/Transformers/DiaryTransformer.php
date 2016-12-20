<?php

namespace CentralCondo\Transformers;

use League\Fractal\TransformerAbstract;
use CentralCondo\Entities\Diary;

/**
 * Class DiaryTransformer
 * @package namespace CentralCondo\Transformers;
 */
class DiaryTransformer extends TransformerAbstract
{

    /**
     * Transform the \Diary entity
     * @param \Diary $model
     *
     * @return array
     */
    public function transform(Diary $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
