<?php

namespace QuadStudio\Rbac\Policies;

use Illuminate\Foundation\Auth\User;
use QuadStudio\Rbac\Models\Role;


class RolePolicy
{


    /**
     * @param User $user
     * @param Role $role
     * @return bool
     */
    public function authorization(User $user, Role $role)
    {
        return $user->hasPermission('authorizations') && $role->authorization_role()->exists();
    }

}
