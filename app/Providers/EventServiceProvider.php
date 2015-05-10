<?php namespace HMIF\Providers;

use Storage;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [

    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        $events->listen('mailer.sending', function(\Swift_Message $message) {
            $emailStorer = app('HMIF\Libraries\EmailStorer');
            $emailStorer->setRaw($message)->setType('out');
            $emailStorer->save();
        });
    }

}
