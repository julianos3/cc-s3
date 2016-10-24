<?php

namespace CentralCondo\Validators\Portal\Communication\Communication;

use Prettus\Validator\LaravelValidator;

class UsersCommunicationValidator extends LaravelValidator
{

    protected $rules = [
        'communication_id' => 'required',
        'user_condominium_id' => 'required',
        'view' => 'required'
    ];

}
