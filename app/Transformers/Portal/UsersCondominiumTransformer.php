<?php

namespace CentralCondo\Transformers\Portal;

use League\Fractal\TransformerAbstract;
use CentralCondo\Entities\Portal\UsersCondominium;

/**
 * Class UsersCondominiumTransformer
 * @package namespace CentralCondo\Transformers;
 */
class UsersCondominiumTransformer extends TransformerAbstract
{

    /**
     * Transform the \UsersCondominium entity
     * @param \UsersCondominium $model
     *
     * @return array
     */
    public function transform(UsersCondominium $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
