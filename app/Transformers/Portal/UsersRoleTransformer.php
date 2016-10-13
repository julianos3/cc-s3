<?php

namespace CentralCondo\Transformers\Portal;

use League\Fractal\TransformerAbstract;
use CentralCondo\Entities\Portal\UsersRole;

/**
 * Class UsersRoleTransformer
 * @package namespace CentralCondo\Transformers\Portal;
 */
class UsersRoleTransformer extends TransformerAbstract
{

    /**
     * Transform the \UsersRole entity
     * @param \UsersRole $model
     *
     * @return array
     */
    public function transform(UsersRole $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
