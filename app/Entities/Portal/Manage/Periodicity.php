<?php

namespace CentralCondo\Entities\Portal\Manage;

use CentralCondo\Entities\Portal\Manage\Maintenance\Maintenance;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Periodicity extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'periodicity';

    protected $fillable = [
        'name',
        'active'
    ];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
    
}
