<?php

namespace CentralCondo\Entities\Portal;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Subscription extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'called';

    protected $fillable = [
        'user_id',
        'name',
        'iugu_id',
        'iugu_plan',
        'trial_ends_at',
        'ends_at'
    ];

}
