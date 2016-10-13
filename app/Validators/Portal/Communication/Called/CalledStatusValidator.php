<?php

namespace CentralCondo\Validators\Portal\Communication\Called;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CalledStatusValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|min:3',
        'condominium_id' => 'required',
        'active' => 'required'
   ];

}
