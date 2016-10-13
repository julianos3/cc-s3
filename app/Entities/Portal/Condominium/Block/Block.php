<?php

namespace CentralCondo\Entities\Portal\Condominium\Block;

use CentralCondo\Entities\Portal\Condominium\Condominium;
use CentralCondo\Entities\Portal\Condominium\Unit\Unit;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Block extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'block';

    protected $fillable = [
        'name',
        'condominium_id'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class, 'block_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'block_id');
    }

}
