<?php

namespace CentralCondo\Transformers;

use League\Fractal\TransformerAbstract;
use CentralCondo\Entities\SecurityCam;

/**
 * Class SecurityCamTransformer
 * @package namespace CentralCondo\Transformers;
 */
class SecurityCamTransformer extends TransformerAbstract
{

    /**
     * Transform the \SecurityCam entity
     * @param \SecurityCam $model
     *
     * @return array
     */
    public function transform(SecurityCam $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
