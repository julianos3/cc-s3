<?php

namespace CentralCondo\Validators\Portal;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ForumResponseValidator extends LaravelValidator
{

    protected $rules = [
        'forum_id' => 'required',
        'user_condominium_id' => 'required',
        'description' => 'required|min:3'
    ];

}
