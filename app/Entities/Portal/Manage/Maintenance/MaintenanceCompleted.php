<?php

namespace CentralCondo\Entities\Portal\Manage\Maintenance;

use CentralCondo\Entities\Portal\Condominium\Provider\Providers;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class MaintenanceCompleted extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'maintenance_completed';

    protected $fillable = [
        'maintenance_id',
        'provider_id',
        'date',
        'description'
    ];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class, 'maintenance_id');
    }

    public function provider()
    {
        return $this->belongsTo(Providers::class);
    }
    
}
