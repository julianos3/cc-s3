<?php

namespace CentralCondo\Validators\Portal\Communication\Message;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class MessageValidator extends LaravelValidator
{

    protected $rules = [
        'condominium_id' => 'required',
        'user_condominium_id' => 'required',
        'subject' => 'required|min:3',
        'message' => 'required|min:3',
        'public' => 'required',
        'type' => 'required'
   ];

}
