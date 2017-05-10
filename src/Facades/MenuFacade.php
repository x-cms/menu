<?php

namespace Xcms\Menu\Facades;

use Illuminate\Support\Facades\Facade;
use Xcms\Menu\Support\Menu;

class MenuFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Menu::class;
    }
}
