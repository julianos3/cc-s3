<?php

namespace CentralCondo\Entities\Portal;

use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Potelo\GuPayment\GuPaymentTrait;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    Transformable
{
    use Authenticatable, Authorizable, CanResetPassword, TransformableTrait, GuPaymentTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_role_id',
        'name',
        'email',
        'sex',
        'phone',
        'iugu_id',
        'password',
        'active',
        'description',
        'cell_phone',
        'birth',
        'cpf',
        'marital_status',
        'formation',
        'institution',
        'conclusion',
        'profession',
        'company',
        'facebook',
        'twitter',
        'linkedin',
        'google_plus',
        'instagram',
        'snapchat',
        'site',
        'imagem'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];

    public function role()
    {
        return $this->belongsTo(UsersRole::class);
    }

    public function userCondominium()
    {
        return $this->hasMany(UsersCondominium::class);
    }

}
