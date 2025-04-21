<?php

namespace Escarter\ActivityLog\Traits;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Escarter\ActivityLog\Actions\LogLoginAction;

trait RegistersLogHandlers
{
    protected function registerEventListeners(): void
    {
        // Log user logins
        Event::listen(Login::class, function (Login $event) {
            app(LogLoginAction::class)->execute($event->user);
        });

        // Add more event listeners as needed
    }
}
