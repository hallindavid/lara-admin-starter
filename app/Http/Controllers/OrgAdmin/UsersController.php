<?php

namespace App\Http\Controllers\OrgAdmin;

use App\Http\Controllers\Controller;
use App\OrgInvitation;
use App\User;
use Permission;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orgusers = auth()->user()->current_org->users;
        $orginvitations = auth()->user()->current_org->invitations;
        $breadcrumbs = [['name'=>'Dashboard'], ['name'=>'Manage Users']];
        return view('org_admin.users.index')->with('breadcrumbs', $breadcrumbs)->with('users',$orgusers)->with('invitations', $orginvitations);
    }

    /**
     * Store a newly created invitation to the organization
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send_invite(Request $request)
    {
        $validated = $request->validate([
            'name'=>[
                'required','string','min:1'
            ],
            'email_address'=>[
                'required','email'
            ]
        ]);

        $org = auth()->user()->current_org;
        if ($org->users->where('email', $validated['email_address'])->count() > 0)
        {
            return response(json_encode([
                'message'=>"User is already part of the organization",
                'errors'=>["user_already_exists"=>["User is already part of the organization"]]
            ]), 422);
        }

        if ($org->invitations->where('email_address', $validated['email_address'])->count() > 0)
        {
            return response(json_encode([
                'message'=>"User has already been invited to organization",
                'errors'=>["user_already_invited"=>["User has already been invited to organization"]]
            ]), 422);
        }

        $invite = new OrgInvitation($validated);
        auth()->user()->current_org->invitations()->save($invite);
        $invite->refresh();

        Mail::to($invite->email_address)->queue(new \App\Mail\InviteToOrg($invite->name, auth()->user()->first_name, auth()->user()->current_org_name()));

        return $invite;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $perms = Permission::get();
        
        $orgPermissions = auth()->user()->current_org->permissions;
        return [
            'first_name'=>$user->first_name,
            'last_name'=>$user->last_name,
            'permissions'=>     $perms->map(function($p) use ($orgPermissions, $user) {
                                    return [
                                        'permission_id'=>$p->id,
                                        'permission_name'=>$p->name,
                                        'permission_description'=>$p->description,
                                        'has_perm'=>($orgPermissions->where('user_id',$user->id)->where('permission_id',$p->id)->count() > 0)
                                    ];
                                })->toArray()
                            ];
        

    }

    public function toggle_permission(User $user, Request $request) {

        $validated = $request->validate([
            'permission_id'=>[
                'required','integer','gte:0'
            ]
        ]);

        auth()->user()->current_org->toggle_user_permission($user->id, $validated['permission_id']);
        return ("Success");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id !== Auth::user()->current_org->user_id) {
            Auth::user()->current_org->users()->detach($user->id);
        }

        return response(json_encode([
                        'message'=>"The organization creator cannot be kicked from the organization",
                        'errors'=>[ "user_is_creator"=>["The organization creator cannot be kicked from the organization"]]
                    ]), 422);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy_invitation(OrgInvitation $invite)
    {
        $invite->delete();
    }
}
