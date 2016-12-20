<?php

namespace CentralCondo\Validators\Portal\Communication\Message;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class MessageGroupValidator extends LaravelValidator
{

    protected $rules = [
        'message_id' => 'required',
        'group_id' => 'required'
   ];

}
