<?php

namespace CentralCondo\Entities\Portal;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Communication extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'communication';

    protected $fillable = [
        'condominium_id',
        'user_condominium_id',
        'name',
        'description',
        'date_display',
        'send_mail',
        'all_user'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function usersCondominium()
    {
        return $this->belongsTo(UsersCondominium::class, 'user_condominium_id');
    }

    public function communicationGroup()
    {
        return $this->belongsTo(CommunicationGroup::class);
    }

}
