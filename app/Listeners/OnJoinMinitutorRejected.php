<?php

namespace App\Listeners;

use App\Events\MinitutorRejected;
use App\Notifications\RequestMinitutorRejectedNotification;

class OnJoinMinitutorRejected
{
    public function handle(MinitutorRejected $event)
    {
        $event->user->notify(new RequestMinitutorRejectedNotification());
    }
}
