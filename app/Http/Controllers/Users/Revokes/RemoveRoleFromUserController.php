<?php

namespace App\Http\Controllers\Users\Revokes;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class RemoveRoleFromUserController extends Controller
{
    public function __invoke(User $user, Role $role)
    {
        $user->removeRole($role);

        return back();
    }
}
