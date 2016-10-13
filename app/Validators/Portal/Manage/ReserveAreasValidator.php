<?php

namespace CentralCondo\Validators\Portal\Manage;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ReserveAreasValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|min:3',
        'condominium_id' => 'required',
        'active' => 'required'
   ];

}
