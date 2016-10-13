<?php

namespace CentralCondo\Validators\Portal\Manage\Maintenance;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class MaintenanceValidator extends LaravelValidator
{

    protected $rules = [
        'condominium_id' => 'required',
        'user_condominium_id' => 'required',
        'periodicity_id' => 'required',
        'name' => 'required|min:3',
        'start_date' => 'required'
   ];

}
