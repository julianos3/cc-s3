<?php

namespace CentralCondo\Validators\Portal;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UsersCondominiumValidator extends LaravelValidator
{

    protected $rules = [
        'user_id' => 'required',
        'user_role_condominium' => 'required',
        'condominium_id' => 'required'
   ];
}
