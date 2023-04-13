<?php

namespace App\Http\Controllers\Roles\Revokes;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RevokePermissionFromRoleController extends Controller
{
    public function __invoke(Role $role, Permission $permission)
    {
        $role->revokePermissionTo($permission);

        return back();
    }
}
