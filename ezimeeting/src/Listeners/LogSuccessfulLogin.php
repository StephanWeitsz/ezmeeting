<?php

namespace Mudtec\Ezimeeting\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Auth\Events\Login;
use Mudtec\Ezimeeting\Models\LoginLog;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = $event->user;
        LoginLog::create([
            'user_id' => $user->id,
            'login_at' => now(),
        ]);
    }
}
