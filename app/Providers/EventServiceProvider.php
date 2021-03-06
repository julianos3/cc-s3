<?php

namespace CentralCondo\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'CentralCondo\Events\SomeEvent' => [
            'CentralCondo\Listeners\EventListener',
        ],
        'CentralCondo\Events\Portal\Communication\SendMail' => [
            'CentralCondo\Listeners\Portal\Communication\SendMailFired',
        ],
        'CentralCondo\Events\Portal\Auth\SendMail' => [
            'CentralCondo\Listeners\Portal\Auth\SendMailFired',
        ],
        'CentralCondo\Events\Portal\Condominium\User\SendMail' => [
            'CentralCondo\Listeners\Portal\Condominium\User\SendMailFired',
        ],
        'CentralCondo\Events\Portal\Auth\SendMailNewUser' => [
            'CentralCondo\Listeners\Portal\Auth\SendMailFiredNewUser',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
