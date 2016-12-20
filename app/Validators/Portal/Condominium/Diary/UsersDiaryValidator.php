<?php

namespace CentralCondo\Validators\Portal\Condominium\Diary;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UsersDiaryValidator extends LaravelValidator
{

    protected $rules = [
        'user_condominium_id' => 'required',
        'diary_id' => 'required'
   ];
}
