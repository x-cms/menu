<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your Module. Just tell Your app the URIs it should respond to
| using a Closure or controller method. Build something great!
|
*/

use Illuminate\Routing\Router;

Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'], function (Router $router) {
    $router->group(['prefix' => 'menus'], function (Router $router) {
        $router->get('', 'MenuController@index')->name('menus.index')->middleware('has-permission:view-menus');

        $router->post('', 'MenuController@index')->name('menus.index')->middleware('has-permission:view-menus');

        $router->get('create', 'MenuController@create')->name('menus.create')->middleware('has-permission:create-menus');

        $router->post('create', 'MenuController@store')->name('menus.store')->middleware('has-permission:create-menus');

        $router->get('edit/{id}', 'MenuController@edit')->name('menus.edit')->middleware('has-permission:edit-menus');

        $router->post('edit/{id}', 'MenuController@update')->name('menus.update')->middleware('has-permission:edit-menus');

        $router->delete('{id}', 'MenuController@destroy')->name('menus.destroy')->middleware('has-permission:delete-menus');
    });
});