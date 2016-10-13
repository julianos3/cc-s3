<?php

namespace CentralCondo\Validators\Portal;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UsefulPhonesValidator extends LaravelValidator
{

    protected $rules = [
        'condominium_id' => 'required',
        'name' => 'required|min:3',
        'phone' => 'required|min:3'
   ];

}
