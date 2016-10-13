<?php

namespace CentralCondo\Entities\Portal;

use CentralCondo\Entities\Portal\Condominium\Condominium;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class State extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'state';

    protected $fillable = [
        'name',
        'uf'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
}
