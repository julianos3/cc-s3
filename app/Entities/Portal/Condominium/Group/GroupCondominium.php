<?php

namespace CentralCondo\Entities\Portal\Condominium\Group;

use CentralCondo\Entities\Portal\Communication\Communication\CommunicationGroup;
use CentralCondo\Entities\Portal\Condominium\Condominium;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class GroupCondominium extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'group_condominium';

    protected $fillable = [
        'name',
        'condominium_id'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function usersGroupCondominium()
    {
        return $this->hasMany(UsersGroupCondominium::class, 'group_id');
    }

    public function communicationGroup()
    {
        return $this->belongsTo(CommunicationGroup::class);
    }

}
