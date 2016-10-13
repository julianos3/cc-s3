<?php

namespace CentralCondo\Validators\Portal\Condominium\Block;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class BlockNomemclatureValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|min:3',
        'label' => 'required|min:3'
   ];

}
