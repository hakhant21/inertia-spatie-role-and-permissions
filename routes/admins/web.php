<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Roles\RoleController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Permissions\PermissionController;

Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admins.index');
});
