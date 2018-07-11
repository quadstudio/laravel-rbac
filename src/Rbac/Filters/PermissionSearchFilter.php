<?php

namespace QuadStudio\Rbac\Filters;

use QuadStudio\Repo\Filters\SearchFilter;
use QuadStudio\Repo\Filters\BootstrapInput;

class PermissionSearchFilter extends SearchFilter
{

    use BootstrapInput;

    protected $render = true;
    protected $search = 'search_permission';

    public function label()
    {
        return trans('rbac::permission.placeholder.search');
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