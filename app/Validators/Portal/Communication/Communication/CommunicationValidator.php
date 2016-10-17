<?php

namespace CentralCondo\Validators\Portal\Communication\Communication;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CommunicationValidator extends LaravelValidator
{

    protected $rules = [
        'condominium_id' => 'required',
        'user_condominium_id' => 'required',
        'name' => 'required|min:3',
        'description' => 'required|min:3',
        'date_display' => 'required',
        'send_mail' => 'required',
        'all_user' => 'required'
   ];

}
