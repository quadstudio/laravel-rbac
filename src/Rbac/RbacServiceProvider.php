<?php

namespace QuadStudio\Rbac;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use QuadStudio\Rbac\Middleware\Ability;
use QuadStudio\Rbac\Middleware\Permission;
use QuadStudio\Rbac\Middleware\Role;

class RbacServiceProvider extends BaseServiceProvider
{

    protected $middleware = [
        'role'       => Role::class,
        'permission' => Permission::class,
        'ability'    => Ability::class
    ];

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind('rbac', function ($app) {
            return new Rbac($app);
        });
        $this->app->alias('rbac', Rbac::class);

        $this
            ->loadConfig()
            ->loadMigrations()
            ->registerEvents();
        $this->registerMiddleware();

    }

    private function registerEvents()
    {

        return $this;
    }

    /**
     * @return $this
     */
    private function loadMigrations()
    {
        $this->loadMigrationsFrom(
            $this->packagePath('database/migrations')
        );

        return $this;
    }

    private function packagePath($path)
    {
        return __DIR__ . "/../{$path}";
    }

    private function loadConfig()
    {
        $this->mergeConfigFrom(
            $this->packagePath('config/rbac.php'), 'rbac'
        );

        return $this;
    }

    private function registerMiddleware()
    {
        if (!empty($this->middleware)) {

            /** @var \Illuminate\Routing\Router $router */
            $router = $this->app['router'];
            $registerMethod = false;

            if (method_exists($router, 'middleware')) {
                $registerMethod = 'middleware';
            } elseif (method_exists($router, 'aliasMiddleware')) {
                $registerMethod = 'aliasMiddleware';
            }

            if ($registerMethod !== false) {
                foreach ($this->middleware as $key => $class) {
                    $router->$registerMethod($key, $class);
                }
            }
        }

    }

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {

        $this->publishAssets()
            ->publishTranslations()
            ->publishConfig();

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\RbacSetupCommand::class,
                Console\RbacResourceMakeCommand::class,
            ]);
        }

        $this->loadViews();

        $this->extendBlade();

    }

    private function publishConfig()
    {
        $this->publishes([
            $this->packagePath('config/rbac.php') => config_path('rbac.php'),
        ], 'config');
    }

    private function publishTranslations()
    {

        $this->loadTranslations();

        $this->publishes([
            $this->packagePath('resources/lang') => resource_path('lang/vendor/rbac'),
        ], 'translations');

        return $this;
    }

    private function loadTranslations()
    {
        $this->loadTranslationsFrom($this->packagePath('resources/lang'), 'rbac');
    }

    /**
     * Publish Portal assets
     *
     * @return $this
     */
    private function publishAssets()
    {

        $this->publishes([
            $this->packagePath('resources/assets') => resource_path('assets'),
        ], 'public');

        return $this;
    }

    private function loadViews()
    {
        $viewsPath = $this->packagePath('resources/views');

        $this->loadViewsFrom($viewsPath, 'rbac');

        $this->publishes([
            $viewsPath => resource_path('views/vendor/rbac'),
        ], 'views');
    }

    private function extendBlade()
    {
        if (class_exists('\Blade')) {
            Blade::directive('role', function ($role) {
                return "<?php if (app('rbac')->hasRole({$role})) : ?>";
            });

            Blade::directive('elserole', function () {
                return "<?php else: // Rbac::role ?>";
            });

            Blade::directive('endrole', function () {
                return "<?php endif; // Rbac::role ?>";
            });

            Blade::directive('permission', function ($permission) {
                return "<?php if (app('rbac')->hasPermission({$permission})) : ?>";
            });

            Blade::directive('elsepermission', function () {
                return "<?php else: // Rbac::permission ?>";
            });

            Blade::directive('endpermission', function () {
                return "<?php endif; // Rbac::permission ?>";
            });

            Blade::directive('notpermission', function ($permission) {
                return "<?php if (!app('rbac')->hasPermission({$permission})) : ?>";
            });

            Blade::directive('endnotpermission', function () {
                return "<?php endif; // Rbac::notpermission ?>";
            });

            Blade::directive('ability', function ($ability) {
                return "<?php if (app('rbac')->hasAbility({$ability})) : ?>";
            });

            Blade::directive('endability', function () {
                return "<?php endif; // Rbac::ability ?>";
            });
        }
    }
}