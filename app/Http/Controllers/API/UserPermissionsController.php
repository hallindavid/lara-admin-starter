<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\PermissionsController;
use App\User;
use App\Permissions;
use App\UserPermission;
class UserPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $userperms = $user->user_permissions;
        $perms = Permissions::all();

        foreach($perms as $p)
        {
            foreach($userperms as $up)
            {
            if($p['id'] == $up['id'])
                {
                    $p['checked'] == 1;
                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //Get Current User Permissions
        $currentPermissions = $user->user_permissions()->pluck('permission_id');
        //Get posted Permissions
        $perms = $request->input('permissions');

        foreach($currentPermissions as $permissionID)
        {
            if (in_array($permissionID, $perms))
            {
                //Remove element from perms array
                $index = array_search($permissionID, $perms);
                if($index !== false){
                    unset($perms[$index]);
                }
            } else {
                //Remove Permission from user
                $user->user_permissions()->where('permission_id', $permissionID)->delete();
            }
        }

        foreach($perms as $permissionID)
        {
            $permissionID = intval($permissionID);
            $user->user_permissions()->save(new UserPermission(['permission_id'=>$permissionID]));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
