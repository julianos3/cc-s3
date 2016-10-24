<?php

namespace CentralCondo\Entities\Portal\Communication\Communication;

use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UsersCommunication extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'users_communication';

    protected $fillable = [
        'communication_id',
        'user_condominium_id',
        'view',
        'date_view'
    ];

    public function communication()
    {
        return $this->belongsTo(Communication::class);
    }

    public function usersCondominium()
    {
        return $this->belongsTo(UsersCondominium::class, 'user_condominium_id');
    }

}
