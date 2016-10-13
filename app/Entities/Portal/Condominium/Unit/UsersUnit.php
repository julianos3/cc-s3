<?php

namespace CentralCondo\Entities\Portal\Condominium\Unit;

use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UsersUnit extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'users_unit';

    protected $fillable = [
        'user_condominium_id',
        'unit_id',
        'user_unit_role'
    ];

    public function usersCondominium()
    {
        return $this->belongsTo(UsersCondominium::class, 'user_condominium_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function usersUnitRole()
    {
        return $this->belongsTo(UsersUnitRole::class, 'user_unit_role');
    }

}
