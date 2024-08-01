<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class CatalogoController extends Controller
{
    public function index($categoriaId = null)
    {
        if ($categoriaId) {
            $productos = Producto::where('id_categoria', $categoriaId)->get();
        } else {
            $productos = Producto::all();
        }

        $categorias = Categoria::all();
        return view('frontend.catalogo.index', compact('productos', 'categorias'));
    }
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('frontend.catalogo.show', compact('producto'));
    }
}
