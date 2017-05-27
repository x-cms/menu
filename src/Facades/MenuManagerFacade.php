<?php

namespace Xcms\Menu\Facades;

use Illuminate\Support\Facades\Facade;
use Xcms\Menu\Supports\MenuManager;

class MenuManagerFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return MenuManager::class;
    }
}
