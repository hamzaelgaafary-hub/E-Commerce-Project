<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use App\Listeners\MergeCartOnLogin;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, array<class-string>>
     */
    protected $listen = [
        Login::class => [MergeCartOnLogin::class],
    ];
    /**
     * 
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        // Event::listen(Login::class, MergeCartOnLogin::class);
    }


}
