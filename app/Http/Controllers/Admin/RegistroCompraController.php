<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\DetalleCompra;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class RegistroCompraController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $producto = Producto::where('nombre', 'LIKE', "%$search%")->first();

            if ($producto) {
                return redirect()->route('admin.tablas.registro_compra.create', ['id_producto' => $producto->id_producto]);
            } else {
                // Obtener todas las categorías para el dropdown de categorías
                $categorias = Categoria::all();
                return view('admin.tablas.registro_compra.create_produc', ['nombre' => $search, 'categorias' => $categorias]);
            }
        }

        return view('admin.tablas.registro_compra.index');
    }

    public function createProduc(Request $request)
    {
        return view('admin.tablas.registro_compra.create_produc');
    }

    public function store_produc(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'nullable|string|max:255',
            'autor' => 'nullable|string|max:255',
            'editorial' => 'nullable|string|max:255',
            'breve_descripcion' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'estado' => 'nullable|in:activo,inactivo',
            'id_categoria' => 'nullable|exists:categorias,id_categoria',
        ]);

        // Manejo de imagen
        if ($request->hasFile('imagen')) {
            $imageName = time() . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('imagenes_productos'), $imageName);
            $request['imagen'] = 'imagenes_productos/' . $imageName;
        } else {
            $request['imagen'] = null;
        }

        // Creación del producto con atributos iniciales
        $producto = Producto::create([
            'nombre' => $request->nombre,
            'autor' => $request->autor,
            'editorial' => $request->editorial,
            'breve_descripcion' => $request->breve_descripcion,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'estado' => $request->estado,
            'id_categoria' => $request->id_categoria,
            // Otros atributos que se completarán más adelante
            'precio_compra' => 0,
            'precio' => 0,
            'descuento' => 0,
            'total_venta' => 0,
            'stock' => 0,
        ]);

        // Redirigir a la vista create para registrar la compra
        return redirect()->route('admin.tablas.registro_compra.create', ['id_producto' => $producto->id_producto]);
    }

    public function create($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        $proveedores = Proveedor::all(); // Obtener los proveedores para el dropdown
        return view('admin.tablas.registro_compra.create', compact('producto', 'proveedores'));
    }
   
    public function store_compra(Request $request)
{
    // Validación de datos
    $request->validate([
        'cantidad' => 'required|integer|min:1',
        'total' => 'required|numeric|min:0.01',
        'nit_recibo' => 'required|string|max:255',
        'fecha' => 'required|date',
        'id_proveedor' => 'required|exists:proveedores,id_proveedor',
        'id_producto' => 'required|exists:productos,id_producto',
    ]);

    // Creación de la compra
    $compra = Compra::create([
        'nit_recibo' => $request->nit_recibo,
        'fecha' => $request->fecha,
        'total_compra' => $request->total, // Utiliza 'total' del formulario como 'total_compra'
        'id_proveedor' => $request->id_proveedor,
        'user_id' => auth()->user()->id, // Obtener el usuario autenticado
    ]);

    // Creación del detalle de la compra
    DetalleCompra::create([
        'cantidad' => $request->cantidad,
        'total' => $request->total,
        'id_producto' => $request->id_producto,
        'id_compra' => $compra->id_compra,
    ]);

    // Actualización del producto con los datos adicionales
    $producto = Producto::findOrFail($request->id_producto);
    $producto->precio_compra = $request->total / $request->cantidad;
    $producto->stock += $request->cantidad;
    $producto->save();

    // Redirigir a la vista para completar el registro del producto
    return redirect()->route('admin.tablas.registro_compra.complete_product', ['id_producto' => $producto->id_producto]);
}

    


    public function complete_product($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        return view('admin.tablas.registro_compra.complete_product', compact('producto'));
    }

    public function update_product(Request $request, $id_producto)
    {
        // Validación de datos
        $request->validate([
            'precio' => 'nullable|numeric|min:0',
            'descuento' => 'nullable|numeric|min:0',
            'total_venta' => 'nullable|numeric|min:0',
        ]);

        // Actualización del producto con los datos finales
        $producto = Producto::findOrFail($id_producto);
        $producto->precio = $request->precio;
        $producto->descuento = $request->descuento;
        $producto->total_venta = $request->total_venta;
        $producto->save();

        return redirect()->route('admin.tablas.registro_compra.index')->with('success', 'Producto actualizado correctamente.');
    }
}
