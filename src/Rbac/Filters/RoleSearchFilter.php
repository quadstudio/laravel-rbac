<?php

namespace QuadStudio\Rbac\Filters;

use QuadStudio\Repo\Filters\SearchFilter;
use QuadStudio\Repo\Filters\BootstrapInput;

class RoleSearchFilter extends SearchFilter
{

    use BootstrapInput;

    protected $render = true;
    protected $search = 'search_role';

    public function label()
    {
        return trans('rbac::role.placeholder.search');
    }

    protected function columns()
    {
        return [
            'name',
            'title',
            'description'
        ];
    }

}