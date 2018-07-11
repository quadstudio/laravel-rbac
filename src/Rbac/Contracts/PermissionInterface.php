<?php

namespace QuadStudio\Rbac\Contracts;
/**
 * @license MIT
 * @package QuadStudio\Rbac
 */
interface PermissionInterface
{
    /**
     * Many-to-Many relations with role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();
}