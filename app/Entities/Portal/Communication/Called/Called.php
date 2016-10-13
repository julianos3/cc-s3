<?php

namespace CentralCondo\Entities\Portal\Communication\Called;

use CentralCondo\Entities\Portal\Condominium\Condominium;
use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Called extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'called';

    protected $fillable = [
        'condominium_id',
        'user_condominium_id',
        'called_category_id',
        'called_status_id',
        'subject',
        'description',
        'visible'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function usersCondominium()
    {
        return $this->belongsTo(UsersCondominium::class, 'user_condominium_id');
    }

    public function calledCategory()
    {
        return $this->belongsTo(CalledCategory::class);
    }

    public function calledStatus()
    {
        return $this->belongsTo(CalledStatus::class);
    }

    public function calledHistoric()
    {
        return $this->belongsTo(CalledHistoric::class);
    }

}
