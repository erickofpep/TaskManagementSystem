<?php

namespace App\Providers;

use App\Events\Event;
use App\Events\TaskAssigned;
use App\Tasks;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
     /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Tasks::created(function ($task) {
            // Event::fire(new TaskAssigned($task));
        });
    }
    
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
  
}
