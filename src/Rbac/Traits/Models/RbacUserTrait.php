<?php
/**
 * User RBAC Trait
 *
 * @license MIT
 * @package QuadStudio\Rbac
 */

namespace QuadStudio\Rbac\Traits\Models;

use QuadStudio\Rbac\Models\Role;

trait RbacUserTrait
{
    /**
     * Attach multiple roles to a user
     *
     * @param mixed $roles
     */
    public function attachRoles(array $roles)
    {
        foreach ($roles as $role) {
            $this->attachRole($role);
        }
    }

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $role
     */
    public function attachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }
        if (is_array($role)) {
            $role = $role['id'];
        }
        $this->roles()->attach($role);
    }

    /**
     * Many-to-Many relations with role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        $key = $this->primaryKey;
        $cacheKey = 'rbac_user_role_' . $this->{$key};
        return cache()->remember($cacheKey, config('cache.ttl'), function () {
            return $this->belongsToMany(
                Role::class,
                'role_user',
                'user_id',
                'role_id');
        });
    }

    /**
     * Detach multiple roles from a user
     *
     * @param mixed $roles
     */
    public function detachRoles(array $roles)
    {
        if (!$roles) {
            $roles = $this->roles()->get();
        }
        foreach ($roles as $role) {
            $this->detachRole($role);
        }
    }

    public function syncRoles($roles)
    {
        if (!is_array($roles)) {
            $roles = [$roles];
        }
        $this->roles()->sync($roles);
    }

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param mixed $role
     */
    public function detachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }
        if (is_array($role)) {
            $role = $role['id'];
        }
        $this->roles()->detach($role);
    }

    /**
     * Checks role(s) and permission(s).
     *
     * @param string|array $roles Array of roles or comma separated string
     * @param string|array $permissions Array of permissions or comma separated string.
     *
     * @throws \InvalidArgumentException
     *
     * @return array|bool
     */
    public function hasAbility($roles, $permissions)
    {
        if (!is_array($roles)) {
            $roles = explode(',', $roles);
        }
        if (!is_array($permissions)) {
            $permissions = explode(',', $permissions);
        }

        $checkedRoles = [];
        $checkedPermissions = [];
        foreach ($roles as $role) {
            $checkedRoles[$role] = $this->hasRole($role);
        }
        foreach ($permissions as $permission) {
            $checkedPermissions[$permission] = $this->hasPermission($permission);
        }

        return !in_array(false, $checkedRoles) && !in_array(false, $checkedPermissions);

    }

    /**
     * Check if user has a permission by its name.
     *
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        if (is_array($permission)) {
            return !in_array(false, array_map(array($this, 'hasPermission'), $permission));
        } else {
            /** @var Role $role */
            foreach ($this->roles()->get() as $role) {
                foreach ($role->permissions()->get() as $role_permission) {

                    if (str_is($permission, $role_permission->name)) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasRole($name)
    {
        if (is_array($name) && !empty($name)) {
            return !in_array(false, array_map(array($this, 'hasRole'), $name));
        } else {
            foreach ($this->roles()->get() as $role) {
                if ($role->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }

}