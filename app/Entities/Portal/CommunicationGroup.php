<?php

namespace CentralCondo\Entities\Portal;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CommunicationGroup extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'communication_group';

    protected $fillable = [
        'communication_id',
        'group_condominium_id'
    ];

    public function communication()
    {
        return $this->belongsTo(Communication::class);
    }

    public function groupCondominium()
    {
        return $this->belongsTo(GroupCondominium::class, 'group_condominium_id');
    }

}
