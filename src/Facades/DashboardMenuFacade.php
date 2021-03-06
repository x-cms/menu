<?php

namespace Xcms\Menu\Facades;

use Illuminate\Support\Facades\Facade;
use Xcms\Menu\Supports\DashboardMenu;

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
