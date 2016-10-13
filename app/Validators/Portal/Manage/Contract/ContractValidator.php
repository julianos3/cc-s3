<?php

namespace CentralCondo\Validators\Portal\Manage\Contract;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ContractValidator extends LaravelValidator
{

    protected $rules = [
        'condominium_id' => 'required',
        'provider_id' => 'required',
        'contract_status_id' => 'required',
        'name' => 'required|min:3',
        'start_date' => 'required',
        'end_date' => 'required'
   ];

}
