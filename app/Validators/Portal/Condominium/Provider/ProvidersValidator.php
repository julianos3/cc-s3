<?php

namespace CentralCondo\Validators\Portal\Condominium\Provider;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProvidersValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|min:3',
        'condominium_id' => 'required',
        'provider_category_id' => 'required',
        'active' => 'required'
   ];

}
