<?php

namespace CentralCondo\Validators\Portal;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UsersGroupCondominiumValidator extends LaravelValidator
{

    protected $rules = [
        'user_condominium_id' => 'required',
        'group_id' => 'required'
   ];
}
