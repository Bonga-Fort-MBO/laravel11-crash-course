<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Note;
use App\Policies\NotePolicy;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }
    protected $policies = [
        Note::class => NotePolicy::class,
    ];


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
