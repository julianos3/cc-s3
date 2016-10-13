<?php

namespace CentralCondo\Entities\Portal\Manage\Contract;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ContractFile extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'contract_file';

    protected $fillable = [
        'contract_id',
        'name',
        'file',
        'extension'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

}
