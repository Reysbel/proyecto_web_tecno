<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;

use App\Models\Factura;
use App\Models\Producto;
use App\Models\LCliente;
use App\Models\detalles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        $query = Factura::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('nit', 'like', "%{$search}%")
                    ->orWhereHas('lcliente', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%");
                    });
            });
        }

        $facturas = $query->paginate(10);
        return view('vendedor.ventas.index', compact('facturas'));
    }

    public function update(Request $request, $id)
{
    DB::beginTransaction();
    
    try {
        $request->validate([
            'id_lcliente' => 'nullable|integer|exists:lclientes,id_lcliente',
            'nombre' => 'nullable|string|max:255',
            'celular' => 'nullable|max:20',
            'correo' => 'nullable|max:255',
            'nit' => 'nullable|max:20',
            'sub_total' => 'nullable|numeric',
            'descuento' => 'nullable|numeric',
            'total_factura' => 'nullable|numeric',
            'metodo_pago' => 'nullable|string|in:efectivo,pagofacil,tigomoney',
            'productos' => 'nullable|array',
            'productos.*.cantidad' => 'nullable|integer|min:1',
            'productos.*.id_producto' => 'nullable|integer|exists:productos,id_producto',
        ]);

        $factura = Factura::findOrFail($id);

        if ($request->has('id_lcliente')) {
            $lcliente = LCliente::findOrFail($request->id_lcliente);
        } else {
            $lcliente = LCliente::create([
                'nombre' => $request->nombre,
                'celular' => $request->celular,
                'correo' => $request->correo,
            ]);
        }

        $factura->update([
            'id_lcliente' => $lcliente->id_lcliente,
            'nit' => $request->nit,
            'sub_total' => $request->sub_total,
            'descuento' => $request->descuento ?? 0,
            'total_factura' => $request->total_factura,
            'metodo_pago' => $request->metodo_pago,
        ]);

        // Elimina los detalles de la factura anteriores
        detalles::where('id_factura', $id)->delete();

        foreach ($request->productos as $producto) {
            $productoModel = Producto::find($producto['id_producto']);

            if ($productoModel->stock < $producto['cantidad']) {
                return redirect()->back()->withErrors([
                    'stock' => 'Stock insuficiente para el producto: ' . $productoModel->nombre,
                ]);
            }

            detalles::create([
                'cantidad' => $producto['cantidad'],
                'total' => ($productoModel->precio - ($producto['descuento'] ?? 0)) * $producto['cantidad'],
                'id_producto' => $producto['id_producto'],
                'id_factura' => $factura->id_factura,
            ]);

            $productoModel->decrement('stock', $producto['cantidad']);
        }

        DB::commit();

        return redirect()->route('vendedor.ventas.index')->with('success', 'Venta actualizada exitosamente.');
    } catch (\Exception $e) {
        DB::rollback();

        return redirect()->back()->withErrors(['error' => 'Error al actualizar la venta: ' . $e->getMessage()]);
    }
}
    // Método para mostrar los detalles de una factura
    public function show($id)
    {
        $factura = Factura::with('detalles.producto')->findOrFail($id);
        return view('vendedor.ventas.show', compact('factura'));
    }

    // Método para eliminar una factura
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $factura = Factura::findOrFail($id);

            // Elimina los detalles de la factura
            detalles::where('id_factura', $id)->delete();

            // Elimina la factura
            $factura->delete();

            DB::commit();

            return redirect()->route('vendedor.ventas.index')->with('success', 'Venta eliminada exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Error al eliminar la venta: ' . $e->getMessage()]);
        }
    }




    public function store(Request $request)
    {
        DB::beginTransaction();
    
        try {
            $request->validate([
                'id_lcliente' => 'nullable|integer|exists:lclientes,id_lcliente',
                'nombre' => 'nullable|string|max:255',
                'celular' => 'nullable|max:20',
                'correo' => 'nullable|max:255',
                'nit' => 'nullable|max:20',
                'sub_total' => 'nullable|numeric',
                'descuento' => 'nullable|numeric',
                'total_factura' => 'nullable|numeric',
                'metodo_pago' => 'nullable|string|in:efectivo,pagofacil,tigomoney',
                'productos' => 'nullable|array',
                'productos.*.cantidad' => 'nullable|integer|min:1',
                'productos.*.id_producto' => 'nullable|integer|exists:productos,id_producto',
            ]);
    
            if ($request->has('id_lcliente')) {
                $lcliente = LCliente::findOrFail($request->id_lcliente);
            } else {
                $lcliente = LCliente::create([
                    'nombre' => $request->nombre,
                    'celular' => $request->celular,
                    'correo' => $request->correo,
                ]);
            }
    
            $factura = Factura::create([
                'user_id' => Auth::id(),
                'id_lcliente' => $lcliente->id_lcliente,
                'nit' => $request->nit,
                'fecha' => now()->toDateString(),
                'hora' => now()->toTimeString(),
                'sub_total' => $request->sub_total,
                'descuento' => $request->descuento ?? 0,
                'total_factura' => $request->total_factura,
                'tipo_moneda' => 2,
                'metodo_pago' => $request->metodo_pago,
                'tipo_cliente' => 'local',
            ]);
    
            foreach ($request->productos as $producto) {
                $productoModel = Producto::find($producto['id_producto']);
    
                if ($productoModel->stock < $producto['cantidad']) {
                    return redirect()->back()->withErrors([
                        'stock' => 'Stock insuficiente para el producto: ' . $productoModel->nombre,
                    ]);
                }
    
                detalles::create([
                    'cantidad' => $producto['cantidad'],
                    'total' => ($productoModel->precio - ($producto['descuento'] ?? 0)) * $producto['cantidad'],
                    'id_producto' => $producto['id_producto'],
                    'id_factura' => $factura->id_factura,
                ]);
    
                $productoModel->decrement('stock', $producto['cantidad']);
            }
    
            DB::commit();
    
            return redirect()->route('vendedor.ventas.index')->with('success', 'Venta creada exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
    
            return redirect()->back()->withErrors(['error' => 'Error al crear la venta: ' . $e->getMessage()]);
        }
    }
    public function edit($id)
{
    $factura = Factura::with('detalles.producto')->findOrFail($id);
    $productos = Producto::all();
    $clientes = LCliente::all();

    return view('vendedor.ventas.edit', compact('factura', 'productos', 'clientes'));
}
}
