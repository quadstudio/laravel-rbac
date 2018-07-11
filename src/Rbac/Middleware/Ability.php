<?php
namespace QuadStudio\Rbac\Middleware;

use Closure;

class Ability extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @param  $roles
     * @param $permissions
     * @return mixed
     */
    public function handle($request, Closure $next, $roles, $permissions)
    {
        if (!is_array($roles)) {
            $roles = explode(config('rbac.delimiter', '|'), $roles);
        }
        if (!is_array($permissions)) {
            $permissions = explode(config('rbac.delimiter', '|'), $permissions);
        }
        if (!$request->user()->ability($roles, $permissions)) {
            $this->unauthorized();
        }

        return $next($request);
    }

}