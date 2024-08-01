<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Lcliente; // Asegúrate de que la ruta del modelo es correcta
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    public function dashboard() {
        return view('vendedor.dashboard');
    }

    public function login() {
        return view('vendedor.auth.login');
    }

    /**
     * Muestra la vista de búsqueda con resultados de productos, categorías y clientes.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request) {
        $query = $request->input('query');

        $productos = Producto::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('autor', 'LIKE', "%{$query}%")
            ->orWhere('editorial', 'LIKE', "%{$query}%")
            ->get();

        $categorias = Categoria::where('nombre', 'LIKE', "%{$query}%")->get();

        $clientes = Lcliente::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('celular', 'LIKE', "%{$query}%")
            ->orWhere('correo', 'LIKE', "%{$query}%")
            ->get();

        return view('vendedor.search', compact('productos', 'categorias', 'clientes', 'query'));
    }
}
