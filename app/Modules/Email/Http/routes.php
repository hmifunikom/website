<?php

Route::group(['namespace' => 'HMIF\Modules\Email\Http\Controllers\Panel'], function()
{
	route_panel(function() {
		if(Request::is('panel/email/*'))
		{
			route_repo('email', HMIF\Modules\Email\Repositories\EmailRepository::class, null, 'email');
            route_repo('attachment', HMIF\Modules\Email\Repositories\AttachmentRepository::class, null, 'email');
		}

        Route::delete('email/junk', ['uses' => 'EmailController@actionDestroy', 'as' => 'panel.email.action.destroy']);

		Route::resource('email', 'EmailController', ['except' => ['edit', 'update']]);
        Route::get('email/{email}/{attachment}', ['uses' => 'EmailController@downloadAttachment', 'as' => 'panel.email.attachment.download']);
	});
});