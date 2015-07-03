<?php

Route::group(['namespace' => 'HMIF\\Modules\User\Http\Controllers\Panel'], function()
{
    Config::set('former.translate_from', 'user::validation.attributes');

    route_panel(function() {
        if(Request::is('panel/user/*'))
        {
            route_repo('user', HMIF\Modules\User\Repositories\UserRepository::class);
        }

        Route::resource('user', 'UserController');
        Route::get('user/create/{nim}', ['uses' =>'UserController@create', 'as' => 'panel.user.createtwo']);
    });

});