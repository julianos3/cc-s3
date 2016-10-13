<?php

namespace CentralCondo\Entities\Portal;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UsersRole extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'users_roles';

    protected $fillable = [
        'name',
        'active'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

}
