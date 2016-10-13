<?php

namespace CentralCondo\Entities\Portal;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class City extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'city';

    protected $fillable = [
        'name',
        'state_id'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
