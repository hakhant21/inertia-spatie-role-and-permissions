<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Roles\RoleController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Permissions\PermissionController;
use App\Http\Controllers\Users\Revokes\RemoveRoleFromUserController;
use App\Http\Controllers\Users\Revokes\RevokePermissionFromUserController;
use App\Http\Controllers\Roles\Revokes\RevokePermissionFromRoleController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('/admin', [AdminController::class, 'index'])->name('admins.index');
    Route::delete('/users/{user}/roles/{role}', RemoveRoleFromUserController::class)->name('users.roles.revoke');
    Route::delete('/users/{user}/permissions/{permission}', RevokePermissionFromUserController::class)->name('users.permissions.revoke');
    Route::delete('/roles/{role}/permissions/{permission}', RevokePermissionFromRoleController::class)->name('roles.permissions.revoke');
});


