<?php

namespace CentralCondo\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Diary extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

}
