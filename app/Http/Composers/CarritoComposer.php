<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\DetalleFactura;
use Illuminate\Support\Facades\Auth;

class CarritoComposer
{
    public function compose(View $view)
    {
        $carritoCount = 0;
        if (Auth::check()) {
            $carritoCount = DetalleFactura::whereHas('factura', function ($query) {
                $query->where('id_cliente', Auth::id())
                      ->where('estado_factura', 'pendiente');
            })->count();
        }
        $view->with('carritoCount', $carritoCount);
    }
}
