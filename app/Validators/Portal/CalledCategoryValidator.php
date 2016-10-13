<?php

namespace CentralCondo\Validators\Portal;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CalledCategoryValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|min:3',
        'condominium_id' => 'required',
        'active' => 'required'
   ];

}
