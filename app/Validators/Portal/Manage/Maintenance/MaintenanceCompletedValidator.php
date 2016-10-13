<?php

namespace CentralCondo\Validators\Portal\Manage\Maintenance;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class MaintenanceCompletedValidator extends LaravelValidator
{

    protected $rules = [
        'maintenance_id' => 'required',
        'provider_id' => 'required',
        'date' => 'required',
        'description' => 'required'
   ];

}
