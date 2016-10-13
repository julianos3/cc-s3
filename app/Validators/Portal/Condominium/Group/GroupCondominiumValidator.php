<?php

namespace CentralCondo\Validators\Portal\Condominium\Group;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class GroupCondominiumValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|min:3',
        'condominium_id' => 'required'
   ];

}
