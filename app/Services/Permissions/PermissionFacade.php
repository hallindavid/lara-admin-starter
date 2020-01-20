<?php

namespace App\Services\Permissions;

use Illuminate\Support\Facades\Facade;

class PermissionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'permission';
    }
}
?>