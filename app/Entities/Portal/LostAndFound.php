<?php

namespace CentralCondo\Entities\Portal;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LostAndFound extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'lost_and_found';

    protected $fillable = [
        'condominium_id',
        'user_condominium_id',
        'name',
        'description',
        'date',
        'found'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function usersCondominium()
    {
        return $this->belongsTo(UsersCondominium::class, 'user_condominium_id');
    }

    public function lostAndFoundCompleted()
    {
        return $this->belongsTo(LostAndFoundCompleted::class);
    }

}
