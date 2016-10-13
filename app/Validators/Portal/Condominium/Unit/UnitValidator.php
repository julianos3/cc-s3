<?php

namespace CentralCondo\Validators\Portal\Condominium\Unit;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UnitValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|min:3',
        'unit_type_id' => 'required',
        'block_id' => 'required',
        'condominium_id' => 'required'
   ];

}
