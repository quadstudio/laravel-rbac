<?php

namespace QuadStudio\Rbac\Filters;

use QuadStudio\Repo\Contracts\RepositoryInterface;
use QuadStudio\Repo\Filter;
use QuadStudio\Rbac\Models\Permission;

class PermissionUserFilter extends Filter
{
    /**
     * @var Permission|null
     */
    private $permission;

    function apply($builder, RepositoryInterface $repository)
    {
        if (!is_null($this->permission)) {
            $builder = $builder->whereHas('roles.permissions', function ($query) {
                $query->where('permissions.id', $this->permission->id);
            });
        } else {
            $builder->whereRaw('false');
        }
        return $builder;
    }

    /**
     * @param Permission $permission
     * @return $this
     */
    public function setPermission(Permission $permission = null)
    {
        $this->permission = $permission;

        return $this;
    }
}