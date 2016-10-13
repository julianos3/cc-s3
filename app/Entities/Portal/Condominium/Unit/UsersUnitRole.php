<?php

namespace CentralCondo\Entities\Portal\Condominium\Unit;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UsersUnitRole extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'users_unit_role';

    protected $fillable = [
        'name',
        'active'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

}
