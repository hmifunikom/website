<?php namespace HMIF\Modules\Event\Providers;

use HMIF\Modules\Event\Entities\Attendee;
use HMIF\Modules\Event\Entities\Event;
use HMIF\Modules\Event\Entities\Observers\AttendeeEvent;
use HMIF\Modules\Event\Entities\Observers\EventEvent;
use HMIF\Modules\Event\Entities\Observers\TicketEvent;
use HMIF\Modules\Event\Entities\Ticket;
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

        Event::observe(new EventEvent());
        Ticket::observe(new TicketEvent());
        Attendee::observe(new AttendeeEvent());
    }

}
