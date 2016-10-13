<?php

namespace CentralCondo\Entities\Portal\Condominium;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Finality extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'finality';

    protected $fillable = [
        'name',
        'active'
    ];

    public function condominium()
    {
        return $this->hasMany(Condominium::class);
    }
    
}
