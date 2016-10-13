<?php

namespace CentralCondo\Entities\Portal\Condominium\Block;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class BlockNomemclature extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'block_nomemclature';

    protected $fillable = [
        'name',
        'label',
        'active'
    ];

}
