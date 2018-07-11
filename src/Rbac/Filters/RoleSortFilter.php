<?php

namespace QuadStudio\Rbac\Filters;

use QuadStudio\Repo\Filters\OrderByFilter;

class RoleSortFilter extends OrderByFilter
{

    /**
     * @return array
     */
    public function defaults(): array
    {
        return [
            $this->table . '.title' => 'ASC'
        ];
    }
}