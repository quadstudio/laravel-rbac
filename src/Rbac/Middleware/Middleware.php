<?php

namespace QuadStudio\Rbac\Middleware;

class Middleware
{
    /**
     * The request is unauthorized, so it handles the aborting/redirecting.
     *
     * @return \Illuminate\Http\Response
     */
    protected function unauthorized()
    {
        $handling = config('rbac.middleware.handler');
        $handler = config("rbac.middleware.handlers.{$handling}");

        if ($handling == 'abort') {
            return app()->abort($handler['code']);
        }

        $redirect = redirect($handler['url']);

        if (!empty($handler['message']['content'])) {
            $redirect->with($handler['message']['type'], $handler['message']['content']);
        }

        return $redirect;
    }
}