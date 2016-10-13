<?php

namespace CentralCondo\Entities\Portal\Condominium\Provider;

use CentralCondo\Entities\Portal\Condominium;
use CentralCondo\Entities\Portal\Condominium\Provider\Providers;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProviderCategory extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'provider_category';

    protected $fillable = [
        'name',
        'active',
        'condominium_id'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function providers()
    {
        return $this->belongsTo(Providers::class);
    }

}
