<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait LivewireAuthorizes
{
    public function auth(): User
    {
        $user = Auth::user();
        abort_unless($user, 401);
        return $user;
    }

    public function activeMinitutor()
    {
        $minitutor = $this->auth()->minitutor;
        abort_unless($minitutor?->active, 403);
        return $minitutor;
    }
}
