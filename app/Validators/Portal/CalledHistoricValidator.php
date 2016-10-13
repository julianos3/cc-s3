<?php

namespace CentralCondo\Validators\Portal;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CalledHistoricValidator extends LaravelValidator
{

    protected $rules = [
        'called_id' => 'required',
        'user_condominium_id' => 'required',
        'called_status_id' => 'required',
        'description' => 'required|min:3'
   ];

}
