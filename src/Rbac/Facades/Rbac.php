<?php

namespace QuadStudio\Rbac\Facades;

use Illuminate\Support\Facades\Facade;

class Rbac extends Facade
{

    /**
     * Register the routes for rbac management.
     *
     * @return void
     */
    public static function routes()
    {
        static::$app->make('rbac')->routes();
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'rbac';
    }


}
