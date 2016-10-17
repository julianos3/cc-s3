<?php

namespace CentralCondo\Validators\Portal\Communication\Communication;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CommunicationGroupValidator extends LaravelValidator
{

    protected $rules = [
        'communication_id' => 'required',
        'group_condominium_id' => 'required'
   ];

}
