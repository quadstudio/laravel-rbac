<?php

namespace QuadStudio\Rbac;

/**
 * This class is the main entry point of rbac
 *
 * @license MIT
 * @package QuadStudio\Rbac
 */

class Rbac
{
    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Create a new confide instance.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Check if the current user has a role or permission by its name
     *
     * @param array|string $roles The role(s) needed.
     * @param array|string $permissions The permission(s) needed.
     *
     * @return bool
     */
    public function hasAbility($roles, $permissions)
    {
        if ($user = $this->user()) {
            return $user->hasAbility($roles, $permissions);
        }

        return false;
    }

    /**
     * Получить текущего аутентифицированного пользователя
     *
     * @return \Illuminate\Foundation\Auth\User|null
     */
    public function user()
    {
        return $this->app->auth->user();
    }


    /**
     * Filters a route for a role or set of roles.
     *
     * If the third parameter is null then abort with status code 403.
     * Otherwise the $result is returned.
     *
     * @param string $route Route pattern. i.e: "admin/*"
     * @param array|string $roles The role(s) needed
     * @param mixed $result i.e: Redirect::to('/')
     *
     * @return mixed
     */
    public function routeNeedsRole($route, $roles, $result = null)
    {
        $filterName = is_array($roles) ? implode('_', $roles) : $roles;
        $filterName .= '_' . substr(md5($route), 0, 6);
        $closure = function () use ($roles, $result) {
            $hasRole = $this->hasRole($roles);
            if (!$hasRole) {
                return empty($result) ? $this->app->abort(403) : $result;
            }
        };
        // Same as Route::filter, registers a new filter
        $this->app->router->filter($filterName, $closure);
        // Same as Route::when, assigns a route pattern to the
        // previously created filter.
        $this->app->router->when($route, $filterName);
    }

    /**
     * Проверить, имеет ли текущий пользователь роль $role
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        if ($user = $this->user()) {
            return $user->hasRole($role);
        }

        return false;
    }

    /**
     * Filters a route for a permission or set of permissions.
     *
     * If the third parameter is null then abort with status code 403.
     * Otherwise the $result is returned.
     *
     * @param string $route Route pattern. i.e: "admin/*"
     * @param array|string $permissions The permission(s) needed
     * @param mixed $result i.e: Redirect::to('/')
     *
     * @return mixed
     */
    public function routeNeedsPermission($route, $permissions, $result = null)
    {
        $filterName = is_array($permissions) ? implode('_', $permissions) : $permissions;
        $filterName .= '_' . substr(md5($route), 0, 6);
        $closure = function () use ($permissions, $result) {
            $hasPerm = $this->hasPermission($permissions);
            if (!$hasPerm) {
                return empty($result) ? $this->app->abort(403) : $result;
            }
        };
        // Same as Route::filter, registers a new filter
        $this->app->router->filter($filterName, $closure);
        // Same as Route::when, assigns a route pattern to the
        // previously created filter.
        $this->app->router->when($route, $filterName);
    }

    /**
     * Проверить, имеет ли текущий пользователь разрешение $permission
     *
     * @param string $permission
     *
     * @return bool
     */
    public function hasPermission($permission)
    {
        if ($user = $this->user()) {
            return $user->hasPermission($permission);
        }

        return false;
    }

    /**
     * Filters a route for role(s) and/or permission(s).
     *
     * If the third parameter is null then abort with status code 403.
     * Otherwise the $result is returned.
     *
     * @param string $route Route pattern. i.e: "admin/*"
     * @param array|string $roles The role(s) needed
     * @param array|string $permissions The permission(s) needed
     * @param mixed $result i.e: Redirect::to('/')
     *
     * @return void
     */
    public function routeNeedsRoleOrPermission($route, $roles, $permissions, $result = null)
    {
        $filterName = is_array($roles) ? implode('_', $roles) : $roles;
        $filterName .= '_' . (is_array($permissions) ? implode('_', $permissions) : $permissions);
        $filterName .= '_' . substr(md5($route), 0, 6);
        $closure = function () use ($roles, $permissions, $result) {
            $hasRole = $this->hasRole($roles);
            $hasPerms = $this->hasPermission($permissions);
            $hasRolePerm = $hasRole && $hasPerms;
            if (!$hasRolePerm) {
                return empty($result) ? $this->app->abort(403) : $result;
            }
        };
        // Same as Route::filter, registers a new filter
        $this->app->router->filter($filterName, $closure);
        // Same as Route::when, assigns a route pattern to the
        // previously created filter.
        $this->app->router->when($route, $filterName);
    }
}