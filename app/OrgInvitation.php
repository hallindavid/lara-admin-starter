<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrgInvitation extends Model
{
    protected $fillable = ['name','email_address'];

    public function organization() {
        return $this->belongsTo('App\Organization');
    }

    public function accept() {
        if (\App\User::where('email',$this->email_address)->count() > 0) {
            $user = \App\User::where('email',$this->email_address)->first();
            $this->organization->users()->attach($user->id);
        }
        $this->responded = true;
        $this->save();
    }

    public function decline() {
        $this->responded = true;
        $this->save();
    }

}
