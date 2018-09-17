<?php

namespace QuadStudio\Rbac\Traits\Controllers\Admin;

use QuadStudio\Rbac\Filters\PermissionSortFilter;
use QuadStudio\Rbac\Filters\PermissionUserFilter;
use QuadStudio\Rbac\Filters\PermissionUserSearchFilter;
use QuadStudio\Rbac\Http\Requests\PermissionRequest;
use QuadStudio\Rbac\Models\Permission;
use QuadStudio\Rbac\Repositories\PermissionRepository;
use QuadStudio\Rbac\Repositories\RoleRepository;
use QuadStudio\Service\Site\Repositories\UserRepository;

trait PermissionControllerTrait
{
    /**
     * @var PermissionRepository
     */
    protected $permissions;
    /**
     * @var RoleRepository
     */
    protected $roles;
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * Create a new controller instance.
     *
     * @param PermissionRepository $permissions
     * @param RoleRepository $roles
     * @param UserRepository $users
     */
    public function __construct(
        PermissionRepository $permissions,
        RoleRepository $roles,
        UserRepository $users
    )
    {
        $this->permissions = $permissions;
        $this->roles = $roles;
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->permissions->trackFilter();

        $this->permissions->pushFilter(new PermissionSortFilter());

        return view('rbac::admin.permission.index', [
            'repository'  => $this->permissions,
            'permissions' => $this->permissions->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rbac::admin.permission.create', [
            'roles' => $this->roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PermissionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission = $this->permissions->create($request->except(['_token', '_method', '_create', 'roles']));
        $permission->attachRoles($request->input('roles', []));
        if ($request->input('_create') == 1) {
            $redirect = redirect()->route('admin.permissions.create')->with('success', trans('rbac::permission.created'));
        } else {
            $redirect = redirect()->route('admin.permissions.index')->with('success', trans('rbac::permission.created'));
        }

        return $redirect;
    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('rbac::admin.permission.show', compact('permission'));
    }

    public function users(Permission $permission)
    {
        $repository = $this->users;
        $users = $this->users
            ->trackFilter()
            ->applyFilter((new PermissionUserFilter())->setPermission($permission))
            ->paginate(config('site.per_page.user', 10));

        return view('rbac::admin.permission.users.index', compact('permission', 'users', 'repository'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('rbac::admin.permission.edit', [
            'roles'      => $this->roles,
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PermissionRequest $request
     * @param  Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {

        $this->permissions->update($request->except('_token', '_method', '_stay', 'roles'), $permission->id);
        $permission->syncRoles($request->input('roles', []));
        if ($request->input('_stay') == 1) {
            $redirect = redirect()->route('admin.permissions.edit', $permission)->with('success', trans('rbac::permission.updated'));
        } else {
            $redirect = redirect()->route('admin.permissions.show', $permission)->with('success', trans('rbac::permission.updated'));
        }

        return $redirect;
    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  Role $role
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Role $role)
//    {
//        if ($role->delete()) {
//            return back()->with('success', trans('rbac::messages.role.deleted'));
//        } else {
//            return back()->with('error', trans('rbac::messages.error'));
//        }
//    }
}