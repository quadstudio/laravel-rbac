<?php


use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => ['online', 'auth', 'admin'],
        'prefix'     => 'admin'
    ],
    function () {

        Route::name('admin')
            ->resource('/roles', 'Admin\RoleController')
            ->middleware('permission:admin.roles');

        Route::group(
            [
                'middleware' => ['permission:admin.roles'],
                'prefix'     => 'roles/{role}'
            ],
            function () {
                Route::name('admin.roles.users')
                    ->get('/users', 'Admin\RoleController@users');
            }
        );

        Route::name('admin')
            ->resource('/permissions', 'Admin\PermissionController')
            ->middleware('permission:admin.permissions');

        Route::group(
            [
                'middleware' => ['permission:admin.permissions'],
                'prefix'     => 'permissions/{permission}'
            ],
            function () {
                Route::name('admin.permissions.users')
                    ->get('/users', 'Admin\PermissionController@users');
            }
        );

    });

