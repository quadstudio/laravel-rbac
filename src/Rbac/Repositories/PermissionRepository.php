<?php

namespace QuadStudio\Rbac\Repositories;

use QuadStudio\Rbac\Filters\PermissionSearchFilter;
use QuadStudio\Rbac\Filters\RoleRelationSearchFilter;
use QuadStudio\Repo\Eloquent\Repository;
use QuadStudio\Rbac\Models\Permission;

class PermissionRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Permission::class;
    }

    /**
     * @return array
     */
    public function track():array
    {
        return [
            PermissionSearchFilter::class,
            RoleRelationSearchFilter::class,
        ];
    }
}