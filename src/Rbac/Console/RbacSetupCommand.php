<?php

namespace QuadStudio\Rbac\Console;

use QuadStudio\Tools\Console\ToolsSetupCommand;

class RbacSetupCommand extends ToolsSetupCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'rbac:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup RBAC';

    /**
     * @param $path
     * @return string
     */
    public function packagePath($path): string
    {
        return __DIR__ . "/../../{$path}";
    }

}