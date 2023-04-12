<?php

namespace App\Http\Controllers\Permissions;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionResource;
use App\Http\Requests\Admins\Permissions\CreateRequest;
use App\Http\Requests\Admins\Permissions\UpdateRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admins/Permissions/Index', [
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admins/Permissions/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        Permission::create($request->validated());

        return to_route('permissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return Inertia::render('Admins/Permissions/Edit', [
            'permission' => new PermissionResource($permission)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,Permission $permission)
    {
        $permission->update([
            'name' => $request->name
        ]);

        return to_route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return to_route('permissions.index');
    }
}
