<?php

namespace CentralCondo\Validators\Portal\Condominium\Block;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class BlockValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|min:3',
        'condominium_id' => 'required'
   ];

}
