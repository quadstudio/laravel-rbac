<?php

namespace QuadStudio\Rbac\Traits\Controllers\Admin;

use QuadStudio\Rbac\Http\Requests\RoleRequest;
use QuadStudio\Rbac\Filters\RolePermissionCountFilter;
use QuadStudio\Rbac\Filters\RoleUserCountFilter;
use QuadStudio\Rbac\Models\Role;
use QuadStudio\Rbac\Repositories\PermissionRepository;
use QuadStudio\Rbac\Repositories\RoleRepository;

trait RoleControllerTrait
{

    protected $permissions;
    protected $roles;

    /**
     * Create a new controller instance.
     *
     * @param PermissionRepository $permissions
     * @param RoleRepository $roles
     */
    public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->permissions = $permissions;
        $this->roles = $roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->roles->trackFilter();
        $this->roles->pushFilter(new RolePermissionCountFilter());
        $this->roles->pushFilter(new RoleUserCountFilter());

        return view('rbac::admin.role.index', [
            'repository' => $this->roles,
            'items'      => $this->roles->paginate(config('rbac.per_page.role', 50))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rbac::admin.role.create', [
            'permissions' => $this->permissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = $this->roles->create($request->except(['_token', '_method', '_create', 'permissions']));
        $role->attachPermissions($request->input('permissions', []));
        if ($request->input('_create') == 1) {
            $redirect = redirect()->back()->with('message', trans('rbac::role.created'));
        } else {
            $redirect = redirect()->route('admin.role.index')->with('message', trans('rbac::role.created'));
        }

        return $redirect;
    }
    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('rbac::admin.role.show', ['role' => $role]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('rbac::admin.role.edit', [
            'permissions' => $this->permissions,
            'role'  => $role
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  RoleRequest $request
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {

        $this->roles->update($request->except('_token', '_method', '_stay', 'permissions'), $role->id);
        $role->syncPermissions($request->input('permissions', []));
        if ($request->input('_stay') == 1) {
            $redirect = redirect()->route('admin.role.edit', $role)->with('success', trans('rbac::role.updated'));
        } else {
            $redirect = redirect()->route('admin.role.show', $role)->with('success', trans('rbac::role.updated'));
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