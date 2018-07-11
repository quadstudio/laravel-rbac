<?php

namespace QuadStudio\Rbac\Middleware;

use Closure;

class Role extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @param  $roles
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!is_array($roles)) {
            $roles = explode(config('rbac.delimiter', '|'), $roles);
        }
        if (!$request->user()->hasRole($roles)) {
            $this->unauthorized();
        }

        return $next($request);
    }

}