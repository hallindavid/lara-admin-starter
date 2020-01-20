<?php

namespace App\Services\Permissions;

use Illuminate\Database\Eloquent\Collection;

class Permission
{
    /**
     * retreives permissions based on passed in array
     *
     * @param mixed $search
     *      array (will return array of permissions)
     *      integer (will return single permission)
     *      string (will return single permission)
     *  
     * @return array of permissions, or single permission (based on input)
     */
    public function get($search=null) {
        if (is_array($search)) {
            return $this->get_by_array($search);
        }

        $perms = $this->all();

        if (is_null($search)) {
            return $perms;
        }

        if (is_integer($search)) {
            return $perms->firstWhere('id',$search);
        }
        
        if (is_string($search)) {
            //first try by slug, then name
            return $perms->firstWhere('slug', $search);
        }

        return false;
    }

    /**
     * retreives all permissions who have id's in the passed in array
     *
     * @param array $permArray
     * @return void
     */
    private function get_by_array(array $array_params)
    {   
        return $this->all()->filter(function($value, $key) use ($array_params) {
            return (    in_array($value->id, $array_params) ||  in_array($value->slug, $array_params));
        });
    }


    private function all() {
        return collect(config('org_permissions.permissions'))->map(function($item) {
            return (object)$item;
        });
    }

    
}
