<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'last_name', 'email', 'password','google_id','timezone','country','state'
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

    public function has_preferences()
    {
        return ((strlen($this->timezone) > 2) && (strlen($this->state) > 2) && (strlen($this->country) > 2));
    }

    /**
     * defines the relationship to organizations which are owned by the user
     *
     * @return void
     */
    public function owned_orgs()
    {
        return $this->hasMany('App\Organization');
    }

    public function current_org() {
        return $this->hasOne('App\Organization', 'id','current_organization');
    }

    public function current_org_name()
    {
        if ($this->current_org()->exists()) {
            return $this->current_org->name;
        }
        return "";
    }

    public function organizations() {
        return $this->belongsToMany('App\Organization', 'organization_users')->withTimestamps();
    }

    public function has_org_access($org_id)
    {
        return ($this->organizations->where('id',$org_id)->count() > 0);
    }

    public function pending_invites() {
        return (\App\OrgInvitation::where('email_address',$this->email)->where('responded', false)->get());
    }
    
    public function fresh_token()
    {
        $this->api_token = Str::random(80);
        $this->save();
    }
}
