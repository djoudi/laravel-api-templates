<?php

namespace Preferred\Domain\Audits\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Neves\Events\Contracts\TransactionalEvent;
use Preferred\Domain\Audits\Entities\Audit;
use Preferred\Domain\Audits\Listeners\Observers\AuditObserver;

class EventServiceProvider extends ServiceProvider implements TransactionalEvent
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Audit::observe(AuditObserver::class);
    }
}
