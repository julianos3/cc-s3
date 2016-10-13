<?php

namespace CentralCondo\Entities\Portal;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Forum extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'forum';

    protected $fillable = [
        'condominium_id',
        'user_condominium_id',
        'name',
        'description',
        'notification'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function usersCondominium()
    {
        return $this->belongsTo(UsersCondominium::class, 'user_condominium_id');
    }

    public function forumResponse()
    {
        return $this->belongsTo(ForumResponse::class);
    }

}
