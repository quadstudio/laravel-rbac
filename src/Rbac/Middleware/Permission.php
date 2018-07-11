<?php

namespace QuadStudio\Rbac\Middleware;

use Closure;

class Permission extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @param $permissions
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions)
    {
        if (!is_array($permissions)) {
            $permissions = explode(config('rbac.delimiter', '|'), $permissions);
        }
        if (!$request->user()->hasPermission($permissions)) {
            $this->unauthorized();
        }

        return $next($request);
    }

}