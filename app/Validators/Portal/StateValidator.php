<?php

namespace CentralCondo\Validators\Portal;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class StateValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|min:3',
        'uf' => 'required|min:2'
   ];

}
