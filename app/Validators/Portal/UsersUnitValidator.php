<?php

namespace CentralCondo\Validators\Portal;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UsersUnitValidator extends LaravelValidator
{

    protected $rules = [
        'user_condominium_id' => 'required',
        'unit_id' => 'required'
   ];
}
