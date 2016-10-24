<?php

namespace CentralCondo\Entities\Portal\Condominium\Group;

use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UsersGroupCondominium extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'users_group_condominium';

    protected $fillable = [
        'user_condominium_id',
        'group_id'
    ];

    public function group()
    {
        return $this->belongsTo(GroupCondominium::class, 'group_id');
    }

    public function usersCondominium()
    {
        return $this->belongsTo(UsersCondominium::class, 'user_condominium_id');
    }

}
