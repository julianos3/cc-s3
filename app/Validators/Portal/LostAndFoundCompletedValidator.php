<?php

namespace CentralCondo\Validators\Portal;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class LostAndFoundCompletedValidator extends LaravelValidator
{

    protected $rules = [
        'lost_and_found_id' => 'required',
        'user_condominium_id' => 'required',
        'description' => 'required|min:3'
   ];

}
