<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;

class MinitutorRejected
{
    use SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $user = $user;
    }
}
