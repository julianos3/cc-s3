<?php

namespace CentralCondo\Entities\Portal;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UsersDiary extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'users_diary';

    protected $fillable = [
        'user_condominium_id',
        'diary_id',
    ];

    public function usersCondominium()
    {
        return $this->belongsTo(UsersCondominium::class, 'user_condominium_id');
    }

    public function diary()
    {
        return $this->belongsTo(Diary::class);
    }

}
