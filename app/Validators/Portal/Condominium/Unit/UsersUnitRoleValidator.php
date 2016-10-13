<?php

namespace CentralCondo\Validators\Portal\Condominium\Unit;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UsersUnitRoleValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required',
        'active' => 'required'
   ];
}
