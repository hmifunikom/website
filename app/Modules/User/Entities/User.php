<?php namespace HMIF\Modules\User\Entities;

use HMIF\Entities\BaseModel;
use HMIF\Modules\User\Presenters\UserPresenter;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use McCool\LaravelAutoPresenter\HasPresenter;
use Hash;

class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract, HasPresenter {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
    protected $primaryKey = 'id_user';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    protected $with = ['userable', 'roles'];

    public function userable()
    {
        return $this->morphTo();
    }

    public function getPresenterClass()
    {
        return UserPresenter::class;
    }

    public function roles()
    {
        return $this->belongsToMany('HMIF\Modules\User\Entities\Role');
    }

    public function permissions()
    {
        return $this->hasMany('HMIF\Modules\User\Entities\Permission');
    }

    public function hasRole($key)
    {
        $hasRole = false;
        foreach ($this->roles as $role) {
            if ($role->name === $key) {
                $hasRole = true;
                break;
            }
        }

        return $hasRole;
    }

    public function setPasswordAttribute($pass){

        $this->attributes['password'] = Hash::make($pass);

    }

}
