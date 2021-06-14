<?php

namespace App\Providers;

use App\Repoimpl\TodoRepoimpl;
use App\Repository\TodoRepository;
use Illuminate\Support\ServiceProvider;

class TodoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(TodoRepository::class, TodoRepoimpl::class);
    }
}
