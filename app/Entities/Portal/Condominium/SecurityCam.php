<?php

namespace CentralCondo\Entities\Portal\Condominium;

use CentralCondo\Entities\Portal\Condominium;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class SecurityCam extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'security_cam';

    protected $fillable = [
        'condominium_id',
        'name',
        'url'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class, 'condominium_id');
    }
    
}
