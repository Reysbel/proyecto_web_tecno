<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Http\Composers\CarritoComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    
    public function boot()
    {
        // Usa CarritoComposer para las vistas especificadas
        View::composer(['cliente.layouts.master', 'cliente.layouts.index', 'cliente.layouts.carrito'], CarritoComposer::class);
        
        // Usa el paginador de Bootstrap 5
        Paginator::useBootstrapFive();
    }
}
