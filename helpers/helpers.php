<?php

if (!function_exists('menu')) {
    function menu()
    {
        return \Xcms\Menu\Facades\DashboardMenuFacade::getFacadeRoot();
    }
}

if (!function_exists('menus_manager')) {
    function menus_manager()
    {
        return \Xcms\Menu\Facades\MenuManagerFacade::getFacadeRoot();
    }
}