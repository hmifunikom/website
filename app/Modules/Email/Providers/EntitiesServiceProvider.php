<?php namespace HMIF\Modules\Email\Providers;

use HMIF\Modules\Email\Entities\Attachment;
use HMIF\Modules\Email\Entities\Email;
use HMIF\Modules\Email\Entities\Observers\AttachmentEvent;
use HMIF\Modules\Email\Entities\Observers\EmailEvent;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EntitiesServiceProvider extends ServiceProvider {

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
        Email::observe(new EmailEvent());
        Attachment::observe(new AttachmentEvent());
    }

}
