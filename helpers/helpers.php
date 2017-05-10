<?php

if (!function_exists('menu')) {
    function menu()
    {
        return \Xcms\Menu\Facades\MenuFacade::getFacadeRoot();
    }
}