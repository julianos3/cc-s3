<?php

namespace CentralCondo\Entities\Portal;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LostAndFoundCompleted extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'lost_and_found_completed';

    protected $fillable = [
        'lost_and_found_id',
        'user_condominium_id',
        'description'
    ];

    public function lostAndFound()
    {
        return $this->belongsTo(LostAndFound::class);
    }

    public function usersCondominium()
    {
        return $this->belongsTo(UsersCondominium::class, 'user_condominium_id');
    }

}
