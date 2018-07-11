<?php

namespace QuadStudio\Rbac\Repositories;

use QuadStudio\Rbac\Filters\RoleSearchFilter;
use QuadStudio\Repo\Eloquent\Repository;
use QuadStudio\Rbac\Filters\RoleUserSearchFilter;
use QuadStudio\Rbac\Filters\PermissionRelationSearchFilter;
use QuadStudio\Rbac\Models\Role;

class RoleRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * @return array
     */
    public function track():array
    {
        return [
            RoleSearchFilter::class,
            PermissionRelationSearchFilter::class,
            RoleUserSearchFilter::class,
        ];
    }
}