<?php

namespace QuadStudio\Rbac\Console;

use QuadStudio\Tools\Console\ToolsResourceMakeCommand;

class RbacResourceMakeCommand extends ToolsResourceMakeCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'rbac:resource';

    protected $signature = 'rbac:resource
                    {--force : Overwrite existing views by default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold RBAC views and routes';

    /**
     * The views that need to be exported.
     *
     * @var array
     */
    protected $views = [
//        'admin/role/index.stub'        => 'admin/role/index.blade.php',
//        'admin/role/row.stub'          => 'admin/role/row.blade.php',
//        'admin/role/create.stub'       => 'admin/role/create.blade.php',
//        'admin/role/show.stub'         => 'admin/role/show.blade.php',
//        'admin/role/edit.stub'         => 'admin/role/edit.blade.php',
//        'admin/permission/index.stub'  => 'admin/permission/index.blade.php',
//        'admin/permission/row.stub'    => 'admin/permission/row.blade.php',
//        'admin/permission/create.stub' => 'admin/permission/create.blade.php',
//        'admin/permission/show.stub'   => 'admin/permission/show.blade.php',
//        'admin/permission/edit.stub'   => 'admin/permission/edit.blade.php',
    ];

    protected $controllers = [
        'admin/RoleController.stub'       => 'Admin/RoleController',
        'admin/PermissionController.stub' => 'Admin/PermissionController',
    ];

    protected $directories = [
        //'resources/views/admin/role',
        //'resources/views/admin/permission',
        'app/Http/Controllers/Admin',
    ];

    protected $seeds = [
        'RbacSeeder.stub' => 'RbacSeeder',
    ];

    public function getStub()
    {
        return __DIR__ . "/stubs/";
    }

    public function getAsset(){
        return __DIR__ . "/../../resources/assets/";
    }

}