<?php

namespace CentralCondo\Entities\Portal\Condominium;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UsersRoleCondominium extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'users_roles_condominium';

    protected $fillable = [
        'name',
        'active'
    ];

    public function userCondominium()
    {
        return $this->hasMany(UsersCondominium::class);
    }

}
