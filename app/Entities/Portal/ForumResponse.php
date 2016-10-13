<?php

namespace CentralCondo\Entities\Portal;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ForumResponse extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'forum_response';

    protected $fillable = [
        'forum_id',
        'user_condominium_id',
        'response_id',
        'description'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function usersCondominium()
    {
        return $this->belongsTo(UsersCondominium::class, 'user_condominium_id');
    }

}
