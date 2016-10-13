<?php

namespace CentralCondo\Validators\Portal\Condominium\Group;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UsersGroupCondominiumValidator extends LaravelValidator
{

    protected $rules = [
        'user_condominium_id' => 'required',
        'group_id' => 'required'
   ];
}
