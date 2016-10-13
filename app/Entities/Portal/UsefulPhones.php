<?php

namespace CentralCondo\Entities\Portal;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UsefulPhones extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'useful_phones';

    protected $fillable = [
        'condominium_id',
        'name',
        'phone'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

}
