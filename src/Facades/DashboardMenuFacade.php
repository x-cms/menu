<?php

namespace Xcms\Menu\Facades;

use Illuminate\Support\Facades\Facade;
use Xcms\Menu\Support\DashboardMenu;

class DashboardMenuFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return DashboardMenu::class;
    }
}
