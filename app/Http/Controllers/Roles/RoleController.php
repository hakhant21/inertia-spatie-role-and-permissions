<?php

namespace App\Http\Controllers\Roles;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Requests\Admins\Roles\CreateRequest;
use App\Http\Requests\Admins\Roles\UpdateRequest;
use App\Http\Resources\PermissionResource;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admins/Roles/Index', [
            'roles' => RoleResource::collection(Role::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admins/Roles/Create', [
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }

    /**
     * Create the specified resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $role = Role::create([
            'name' => $request->name
        ]);

        if($request->has('permissions')) {
            $role->syncPermissions($request->input('permissions.*.name'));
        }

        return to_route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $role->load('permissions');

        return Inertia::render('Admins/Roles/Edit', [
            'role' => new RoleResource($role),
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,Role $role)
    {
         $role->update([
            'name' => $request->name,
         ]);

         $role->syncPermissions($request->input('permissions.*.name'));

         return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return to_route('roles.index');
    }
}
