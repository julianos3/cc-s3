<?php

namespace CentralCondo\Validators\Portal;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CityValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|min:3',
        'state_id' => 'required'
   ];

}
