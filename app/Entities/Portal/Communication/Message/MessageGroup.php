<?php

namespace CentralCondo\Entities\Portal\Communication\Message;

use CentralCondo\Entities\Portal\Condominium\Group\GroupCondominium;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class MessageGroup extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'message_group';

    protected $fillable = [
        'message_id',
        'group_id'
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function group()
    {
        return $this->belongsTo(GroupCondominium::class);
    }

}
