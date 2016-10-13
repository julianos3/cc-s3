<?php

namespace CentralCondo\Entities\Portal;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CalledStatus extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'called_status';

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

    public function calledHistoric()
    {
        return $this->belongsTo(CalledHistoric::class);
    }

}
