<?php

namespace App\Observers;

use Permission;
use App\Organization;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\Permissions\PermissionFacade;
use Illuminate\Support\Str;
class OrganizationObserver
{
    /**
     * Handle the organization "created" event.
     *
     * @param  \App\Organization  $organization
     * @return void
     */
    public function created(Organization $organization)
    {
        $user = \App\User::findOrFail($organization->user_id);
        $organization->users()->attach($user->id);
        $user->current_organization = $organization->refresh()->id;
        $user->save();

        //1000 is the configured "Org-Admin" permission
        $organization->toggle_user_permission($user->id, 1000);
    

    }

    /**
     * Handle the organization "updated" event.
     *
     * @param  \App\Organization  $organization
     * @return void
     */
    public function updated(Organization $organization)
    {
        
    }

    /**
     * Handle the organization "deleted" event.
     *
     * @param  \App\Organization  $organization
     * @return void
     */
    public function deleted(Organization $organization)
    {

    }

    /**
     * Handle the organization "restored" event.
     *
     * @param  \App\Organization  $organization
     * @return void
     */
    public function restored(Organization $organization)
    {
        //
    }

    /**
     * Handle the organization "force deleted" event.
     *
     * @param  \App\Organization  $organization
     * @return void
     */
    public function forceDeleted(Organization $organization)
    {
        //
    }
}
