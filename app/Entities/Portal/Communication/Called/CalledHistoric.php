<?php

namespace CentralCondo\Entities\Portal\Communication\Called;

use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CalledHistoric extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'called_historic';

    protected $fillable = [
        'called_id',
        'user_condominium_id',
        'called_status_id',
        'description'
    ];

    public function called()
    {
        return $this->belongsTo(Called::class);
    }

    public function usersCondominium()
    {
        return $this->belongsTo(UsersCondominium::class, 'user_condominium_id');
    }

    public function calledStatus()
    {
        return $this->belongsTo(CalledStatus::class);
    }

}
