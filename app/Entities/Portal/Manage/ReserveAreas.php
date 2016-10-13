<?php

namespace CentralCondo\Entities\Portal\Manage;

use CentralCondo\Entities\Portal\Condominium;
use CentralCondo\Entities\Portal\Diary;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ReserveAreas extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'reserve_areas';

    protected $fillable = [
        'condominium_id',
        'name',
        'active'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function diary()
    {
        return $this->belongsTo(Diary::class);
    }
    
}
