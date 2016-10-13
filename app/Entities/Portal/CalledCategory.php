<?php

namespace CentralCondo\Entities\Portal;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CalledCategory extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'called_category';

    protected $fillable = [
        'name',
        'condominium_id',
        'active'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function called()
    {
        return $this->belongsTo(Called::class);
    }

}
