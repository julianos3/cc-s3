<?php

namespace CentralCondo\Validators\Portal\Condominium\Diary;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class DiaryValidator extends LaravelValidator
{

    protected $rules = [
        'condominium_id' => 'required',
        'user_condominium_id' => 'required',
        'reserve_area_id' => 'required',
        'reason' => 'required|min:3',
        'all_day' => 'required'
   ];

}
