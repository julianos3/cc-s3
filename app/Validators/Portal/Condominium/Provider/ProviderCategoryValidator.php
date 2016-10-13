<?php

namespace CentralCondo\Validators\Portal\Condominium\Provider;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProviderCategoryValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|min:3',
        'active' => 'required',
        'condominium_id' => 'required'
   ];

}
