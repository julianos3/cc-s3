<?php

namespace CentralCondo\Transformers;

use League\Fractal\TransformerAbstract;
use CentralCondo\Entities\UserMessage;

/**
 * Class UserMessageTransformer
 * @package namespace CentralCondo\Transformers;
 */
class UserMessageTransformer extends TransformerAbstract
{

    /**
     * Transform the \UserMessage entity
     * @param \UserMessage $model
     *
     * @return array
     */
    public function transform(UserMessage $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
