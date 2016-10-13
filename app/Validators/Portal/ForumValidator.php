<?php

namespace CentralCondo\Validators\Portal;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ForumValidator extends LaravelValidator
{

    protected $rules = [
        'condominium_id' => 'required',
        'user_condominium_id' => 'required',
        'name' => 'required|min:3',
        'description' => 'required|min:3',
        'notification' => 'required'
    ];

}
