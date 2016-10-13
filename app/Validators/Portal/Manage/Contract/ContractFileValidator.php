<?php

namespace CentralCondo\Validators\Portal\Manage\Contract;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ContractFileValidator extends LaravelValidator
{

    protected $rules = [
        'contract_id' => 'required',
        'name' => 'required',
        'file' => 'required|min:3',
        'extension' => 'required'
   ];

}
