<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\TodoList;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Observers\TodoListObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Configuración para fechas en español
        Carbon::setUTF8(true);
        Carbon::setLocale(config('app.locale'));
        setlocale(LC_TIME, config('app.locale'));
        //setlocale(LC_ALL, 'es_AR', 'es', 'ES', 'es_AR.utf8');
        //setlocale(LC_ALL, 'es_ES', 'es', 'ES', 'es_ES.utf8');

        // Observers
        TodoList::observe(TodoListObserver::class);

        // Paginator
        Paginator::useBootstrap();

        // Compartir informacion a todas las vistas
        $global_notifications = Notification::where('state','0')->get();
        view()->share('global_notifications', $global_notifications);
    }
}
