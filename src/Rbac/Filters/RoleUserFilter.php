<?php

namespace QuadStudio\Rbac\Filters;

use QuadStudio\Repo\Contracts\RepositoryInterface;
use QuadStudio\Repo\Filter;
use QuadStudio\Rbac\Models\Role;

class RoleUserFilter extends Filter
{
    /**
     * @var Role|null
     */
    private $role;

    function apply($builder, RepositoryInterface $repository)
    {
        if (!is_null($this->role)) {
            $builder = $builder->whereHas('roles', function ($query) {
                $query->where('roles.id', $this->role->id);
            });
        } else {
            $builder->whereRaw('false');
        }
        return $builder;
    }

    /**
     * @param Role $role
     * @return $this
     */
    public function setRole(Role $role = null)
    {
        $this->role = $role;

        return $this;
    }
}