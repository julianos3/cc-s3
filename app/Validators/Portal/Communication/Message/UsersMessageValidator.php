<?php

namespace CentralCondo\Validators\Portal\Communication\Message;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UsersMessageValidator extends LaravelValidator
{

    protected $rules = [
        'message_id' => 'required',
        'user_condominium_id' => 'required'
   ];

}
