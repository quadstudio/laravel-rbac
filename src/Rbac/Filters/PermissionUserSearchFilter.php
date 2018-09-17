<?php

namespace QuadStudio\Rbac\Filters;

use QuadStudio\Repo\Filters\BootstrapInput;
use QuadStudio\Repo\Filters\SearchFilter;

class PermissionUserSearchFilter extends SearchFilter
{

    use BootstrapInput;

    protected $render = true;
    protected $search = 'search_user';

    public function label()
    {
        return trans('site::user.placeholder.search');
    }

    protected function columns()
    {
        return [
            env('DB_PREFIX', '') . 'users.name',
            env('DB_PREFIX', '') . 'users.email',
        ];
    }

    protected function attributes()
    {
        $attributes = parent::attributes();
        $attributes->put('style', 'min-width: 208px;');

        return $attributes;
    }

}