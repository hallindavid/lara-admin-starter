<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Permission;

class Organization extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name'];

    public function owner() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'organization_users')->withTimestamps();
    }

    public function invitations() {
        return $this->hasMany('App\OrgInvitation', 'organization_id','id');
    }

    public function permissions() {
        return $this->hasMany('App\UserPermission', 'organization_id', 'id');
    }

    public function check_user_permission($user_id, $permission)
    {
        $perm = Permission::get($permission);
        if ($perm != false)
        {
            return ($this->permissions->where('permission_id',$perm->id)->where('user_id',$user_id)->count() > 0);
        }
        return false;
    }

    public function toggle_user_permission($user_id, $permission)
    {
        $perm = Permission::get($permission);
        if ($perm != false)
        {
            if ($this->check_user_permission($user_id, $perm->id))
            {
                //this means they do have it.
                $this->permissions()->where('permission_id', $perm->id)->where('user_id', $user_id)->delete();
            } else {
                $this->permissions()->create(['permission_id'=>$perm->id, 'user_id'=>$user_id]);
            }
        }
    }

 
}
