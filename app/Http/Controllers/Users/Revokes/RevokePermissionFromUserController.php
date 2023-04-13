<?php

namespace App\Http\Controllers\Users\Revokes;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RevokePermissionFromUserController extends Controller
{
    public function __invoke(User $user, Permission $permission)
    {
        $user->revokePermissionTo($permission);

        return back();
    }
}
