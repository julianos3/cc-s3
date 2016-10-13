<?php

namespace CentralCondo\Entities\Portal\Communication\Message;

use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UsersMessage extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'users_message';

    protected $fillable = [
        'message_id',
        'user_condominium_id'
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function usersCondominium()
    {
        return $this->belongsTo(UsersCondominium::class, 'user_condominium_id');
    }

}
