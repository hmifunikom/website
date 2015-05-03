<?php

Route::group(['namespace' => 'HMIF\\Modules\User\Http\Controllers\Panel'], function()
{
    Former::setOption('translate_from', 'user::validation.attributes');

    route_panel(function() {
        if(Request::is('panel/user/*'))
        {

        }

        Route::resource('user', 'UserController');
    });

});