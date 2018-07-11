<?php

namespace QuadStudio\Rbac\Filters;

use QuadStudio\Repo\Contracts\RepositoryInterface;
use QuadStudio\Repo\Filter;

class RolePermissionCountFilter extends Filter
{


    function apply($builder, RepositoryInterface $repository)
    {
        $builder = $builder->withCount('permissions');
        return $builder;
    }

}