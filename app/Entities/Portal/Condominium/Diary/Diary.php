<?php

namespace CentralCondo\Entities\Portal\Condominium\Diary;

use CentralCondo\Entities\Portal\Condominium\Condominium;
use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use CentralCondo\Entities\Portal\Manage\ReserveAreas\ReserveAreas;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Diary extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'diary';

    protected $fillable = [
        'condominium_id',
        'user_condominium_id',
        'reserve_area_id',
        'reason',
        'start_date',
        'end_date',
        'all_day',
        'description'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function userCondominium()
    {
        return $this->belongsTo(UsersCondominium::class);
    }

    public function reserveArea()
    {
        return $this->belongsTo(ReserveAreas::class);
    }

    public function usersDiary()
    {
        return $this->belongsTo(UsersDiary::class);
    }

}
