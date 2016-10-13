<?php

namespace CentralCondo\Validators\Portal;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UnitValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|min:3',
        'unit_type_id' => 'required'
   ];

}
