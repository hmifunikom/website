<?php namespace HMIF\Modules\User\Entities;

use HMIF\Entities\BaseModel;
use HMIF\Modules\User\Presenters\UserPresenter;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use McCool\LaravelAutoPresenter\HasPresenter;

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
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    protected $with = ['userable'];

    public function userable()
    {
        return $this->morphTo();
    }

    public function getPresenterClass()
    {
        return UserPresenter::class;
    }

}
