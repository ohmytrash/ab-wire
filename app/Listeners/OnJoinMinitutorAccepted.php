<?php

namespace App\Listeners;

use App\Events\MinitutorAccepted;
use App\Notifications\RequestMinitutorAcceptedNotification;

class OnJoinMinitutorAccepted
{
    public function handle(MinitutorAccepted $event)
    {
        $event->user->notify(new RequestMinitutorAcceptedNotification());
    }
}
