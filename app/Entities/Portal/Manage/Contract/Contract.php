<?php

namespace CentralCondo\Entities\Portal\Manage\Contract;

use CentralCondo\Entities\Portal\Condominium;
use CentralCondo\Entities\Portal\Condominium\Provider\Providers;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Contract extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'contract';

    protected $fillable = [
        'condominium_id',
        'provider_id',
        'contract_status_id',
        'name',
        'description',
        'start_date',
        'end_date',
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function providers()
    {
        return $this->belongsTo(Providers::class, 'provider_id');
    }

    public function contractStatus()
    {
        return $this->belongsTo(ContractStatus::class);
    }

    public function contractFile()
    {
        return $this->hasMany(ContractFile::class);
    }

}
