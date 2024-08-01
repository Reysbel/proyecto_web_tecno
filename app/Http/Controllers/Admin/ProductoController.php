<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use File;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $productos = Producto::query()
            ->where('nombre', 'like', "%{$search}%")
            ->get();

        $categorias = Categoria::all(); // Obtener todas las categorías para el formulario de creación y edición

        return view('admin.tablas.producto.index', compact('productos', 'search', 'categorias'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.tablas.producto.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'autor' => 'required|string|max:100',
            'editorial' => 'required|string|max:100',
            'breve_descripcion' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_compra' => 'required|numeric',
            'precio' => 'required|numeric',
            'descuento' => 'nullable|numeric',
            'total_venta' => 'required|numeric',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock' => 'required|integer',
            'estado' => 'required|in:activo,inactivo',
            'id_categoria' => 'required|exists:categorias,id_categoria'
        ]);

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->autor = $request->autor;
        $producto->editorial = $request->editorial;
        $producto->breve_descripcion = $request->breve_descripcion;
        $producto->descripcion = $request->descripcion;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio = $request->precio;
        $producto->descuento = $request->descuento;
        $producto->total_venta = $request->total_venta;
        $producto->stock = $request->stock;
        $producto->estado = $request->estado;
        $producto->id_categoria = $request->id_categoria;

        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $producto->imagen = "uploads/" . $imageName;
        }

        $producto->save();

        return redirect()->route('admin.tablas.producto.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.tablas.producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();

        return view('admin.tablas.producto.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'autor' => 'required|string|max:100',
            'editorial' => 'required|string|max:100',
            'breve_descripcion' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_compra' => 'required|numeric',
            'precio' => 'required|numeric',
            'descuento' => 'nullable|numeric',
            'total_venta' => 'required|numeric',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock' => 'required|integer',
            'estado' => 'required|in:activo,inactivo',
            'id_categoria' => 'required|exists:categorias,id_categoria'
        ]);

        $producto->nombre = $request->nombre;
        $producto->autor = $request->autor;
        $producto->editorial = $request->editorial;
        $producto->breve_descripcion = $request->breve_descripcion;
        $producto->descripcion = $request->descripcion;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio = $request->precio;
        $producto->descuento = $request->descuento;
        $producto->total_venta = $request->total_venta;
        $producto->stock = $request->stock;
        $producto->estado = $request->estado;
        $producto->id_categoria = $request->id_categoria;

        if ($request->hasFile('imagen')) {
            if (File::exists(public_path($producto->imagen))) {
                File::delete(public_path($producto->imagen));
            }
            $image = $request->file('imagen');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $producto->imagen = "uploads/" . $imageName;
        }

        $producto->save();

        return redirect()->route('admin.tablas.producto.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        if (File::exists(public_path($producto->imagen))) {
            File::delete(public_path($producto->imagen));
        }
        $producto->delete();
        return redirect()->route('admin.tablas.producto.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
}
