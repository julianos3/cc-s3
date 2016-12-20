<?php

namespace CentralCondo\Entities\Portal\Communication\Message;

use CentralCondo\Entities\Portal\Condominium\Condominium;
use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Message extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'message';

    protected $fillable = [
        'condominium_id',
        'user_condominium_id',
        'subject',
        'message',
        'public',
        'type'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function usersCondominium()
    {
        return $this->belongsTo(UsersCondominium::class, 'user_condominium_id');
    }

    public function usersMessage()
    {
        return $this->hasMany(UsersMessage::class, 'message_id');
    }

    public function messageReply()
    {
        return $this->hasMany(MessageReply::class, 'message_id');
    }

    public function group()
    {
        return $this->belongsTo(MessageGroup::class);
    }

}
