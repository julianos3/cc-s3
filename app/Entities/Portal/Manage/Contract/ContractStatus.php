<?php

namespace CentralCondo\Entities\Portal\Manage\Contract;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ContractStatus extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'contract_status';

    protected $fillable = [
        'title',
        'active'
    ];

    public function Contract()
    {
        return $this->belongsTo(Contract::class);
    }
    
}
