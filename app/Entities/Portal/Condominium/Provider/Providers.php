<?php

namespace CentralCondo\Entities\Portal\Condominium\Provider;

use CentralCondo\Entities\Portal\Condominium;
use CentralCondo\Entities\Portal\Manage\Contract\Contract;
use CentralCondo\Entities\Portal\Manage\Maintenance\MaintenanceCompleted;
use CentralCondo\Entities\Portal\Condominium\Provider\ProviderCategory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Providers extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'providers';

    protected $fillable = [
        'condominium_id',
        'provider_category_id',
        'name',
        'active',
        'description'
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class, 'condominium_id');
    }

    public function providerCategory()
    {
        return $this->belongsTo(ProviderCategory::class, 'provider_category_id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function maintenanceCompleted()
    {
        return $this->belongsTo(MaintenanceCompleted::class);
    }

}
