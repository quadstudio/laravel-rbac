<?php

namespace QuadStudio\Rbac\Http\ViewComposers;

use QuadStudio\Rbac\Rbac;
use Illuminate\View\View;

class RbacComposer
{
    /**
     * @var Rbac
     */
    private $rbac;

    public function __construct(
        Rbac $rbac
    )
    {
        $this->rbac = $rbac;
    }

    public function compose(View $view)
    {
        $view->with('rbac', $this->rbac);
    }
}
