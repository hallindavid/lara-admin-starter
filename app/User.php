<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jamesh\Uuid\HasUuid;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use Notifiable, HasUuid, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'is_admin', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * setEmailAttribute will make all emails lowercase
     *
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * getEmailAttribute will make all emails lowercase
     *
     */
    public function getEmailAttribute($value)
    {
        return strtolower($value);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function user_permissions()
    {
        return $this->hasMany('App\UserPermission');
    }

    /**
     * This returns the full list of permissions that the user belongs too
     *
     * @param null
     * @return array of permissions the user has
     */
    public function permissions()
    {
        return $this->hasManyThrough(
            'App\Permission',
            'App\UserPermission',
            'user_id', // Foreign key on users table...
            'id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'permission_id' // Local key on users table...
        );
    }

    /**
     * This returns whether a user has permission based off of the parameter
     *
     * @param $permission -> string value of the title of the permission
     * @return true or false
     */
    public function amI($permission)
    {
        return ($this->permissions()->where('title', $permission)->get()->count() > 0);
    }

    /**
     * This returns whether a user has permission based off of the parameter
     *
     * @param $permission -> string value of the title of the permission
     * @return true or false
     */
    public function grant_permission_to_user($permissionID)
    {
        $this->user_permissions()->save(new UserPermission(['permission_id'=>$permissionID]));
    }
}
