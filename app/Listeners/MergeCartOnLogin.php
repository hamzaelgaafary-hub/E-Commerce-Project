<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use App\Services\CartService;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class MergeCartOnLogin
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
    public function handle(Login $event): void
    {
        if (session()->has('cart')) {
            app(CartService::class)->mergeSessionToDatabase($event->user instanceof User ? $event->user : null);
        }
    }
}
