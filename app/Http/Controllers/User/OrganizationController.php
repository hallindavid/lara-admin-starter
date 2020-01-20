<?php

namespace App\Http\Controllers\User;

use App\Organization;
use Illuminate\Support\Facades\Auth;
use App\OrgInvitation;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrganizationRequest;
use App\Http\Resources\MyOrganizationResource;
use App\Http\Resources\MyInvitationResource;

use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    //Create Organization
    public function new_org()
    {
        return view('user.new_org'); 
    }

    /**
     * Show the form for switching to a new org
     *
     * @return \Illuminate\Http\Response
     */

    public function change_org(){
        $pendingInvites = MyInvitationResource::collection(auth()->user()->pending_invites());
        $userOrgs = MyOrganizationResource::collection(auth()->user()->organizations);
        return view('user.change_org')->with('userorgs',$userOrgs)->with('invitations',$pendingInvites);
    }  

    /**
     * Retreives a list of the currently authenticated user's organizations which they are tied to
     */
    public function my_organizations() {
        return MyOrganizationResource::collection(auth()->user()->organizations);
    }


    /**
     * Allows an authenticated user to create a new organization
     */
    public function store_organization(CreateOrganizationRequest $request) {
        $validated = $request->validated();
        $org = new Organization($validated);
        Auth::user()->owned_orgs()->save($org);
        
    }

    public function switch_organization(Request $request) {
        $validated = $request->validate([
            'organization_id'=>'required|integer'
        ]);

        $user = Auth::user();
        if ($user->has_org_access($validated['organization_id']))
        {
            $user->current_organization = $validated['organization_id'];
            $user->save();
            return response('Updated', 200);
        }

        return response("Unable to find organization", 422);
    }

    public function leave_organization(Request $request, Organization $org) {
        
        if ($org->user_id != Auth::user()->id) {
            Auth::user()->organizations()->detach($org->id);
            return "Success";
        }

        return response(json_encode([
                        'message'=>"Unable to leave that organization",
                        'errors'=>[ "unable_to_leave_org"=>["Unable to leave that organization"]]
                    ]), 422);
    }

    public function current_org() {
        return auth()->user()->current_org;
    }

    public function accept_invitation(OrgInvitation $invite) {
        if ($invite->email_address == auth()->user()->email)
        {
            $invite->accept();
            
            return new MyOrganizationResource(Organization::find($invite->organization_id));
        }
        
        return response(json_encode([
                            'message'=>"Invitation Not Found",
                            'errors'=>[ "invite_not_found"=>["Invitation Not Found"]]
                        ]), 422);
    }

    public function decline_invitation(OrgInvitation $invite) {
        if ($invite->email_address == auth()->user()->email)
        {
            $invite->decline();
            return "Success";
        }

        return response(json_encode([
            'message'=>"Invitation Not Found",
            'errors'=>[ "invite_not_found"=>["Invitation Not Found"]]
        ]), 422);
    }

}
