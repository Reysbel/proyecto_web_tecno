<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;

use App\Models\Producto;
use App\Models\DetalleFactura;
use App\Models\Factura;
use Illuminate\Http\Request;

class VendedorProducController extends Controller
{
    public function index()
    {
        $productos = Producto::where('estado', 'activo')->get();

        $user_id = auth()->id();
        $factura = Factura::where('user_id', $user_id)
            ->where('estado_factura', 'pendiente')
            ->first();

        if (!$factura) {
            $factura = new Factura();
            $factura->user_id = $user_id;
            $factura->id_cliente = null; // Cambiado a id_cliente
            $factura->nit = null;
            $factura->fecha = now();
            $factura->sub_total = 0;
            $factura->descuento = 0;
            $factura->total_factura = 0;
            $factura->metodo_pago = 'efectivo';
            $factura->estado_factura = 'pendiente';
            $factura->save();
        }

        $detalles = $factura->detalles()->with('producto')->get();

        return view('vendedor.layouts.index', compact('productos', 'detalles', 'factura'));
    }

    public function agregarAlCarrito(Request $request, $id_producto)
    {
        $user_id = auth()->id();

        $factura = Factura::where('user_id', $user_id)
            ->where('estado_factura', 'pendiente')
            ->first();

        if (!$factura) {
            $factura = new Factura();
            $factura->user_id = $user_id;
            $factura->id_cliente = null; // Cambiado a id_cliente
            $factura->nit = null;
            $factura->fecha = now();
            $factura->sub_total = 0;
            $factura->descuento = 0;
            $factura->total_factura = 0;
            $factura->metodo_pago = 'efectivo';
            $factura->estado_factura = 'pendiente';
            $factura->save();
        }

        $detalleFactura = new DetalleFactura();
        $detalleFactura->id_producto = $id_producto;
        $detalleFactura->id_factura = $factura->id_factura;
        $detalleFactura->cantidad = 1; // Puedes ajustar la cantidad según tus necesidades
        $detalleFactura->total = Producto::find($id_producto)->precio; // Precio del producto
        $detalleFactura->save();

        $factura->sub_total += $detalleFactura->total;
        $factura->total_factura = $factura->sub_total - $factura->descuento;
        $factura->save();

        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }

    public function actualizarCantidad(Request $request, $id_detalle)
    {
        $detalle = DetalleFactura::findOrFail($id_detalle);

        $detalle->cantidad = $request->cantidad;
        $detalle->total = $detalle->producto->precio * $request->cantidad; // Actualizar el total basado en la cantidad
        $detalle->save();

        $factura = $detalle->factura;
        $factura->sub_total = $factura->detalles->sum('total');
        $factura->total_factura = $factura->sub_total - $factura->descuento;
        $factura->save();

        return redirect()->back()->with('success', 'Cantidad actualizada.');
    }

    public function eliminarDelCarrito($id_detalle)
    {
        $detalle = DetalleFactura::findOrFail($id_detalle);

        $factura = $detalle->factura;
        $factura->sub_total -= $detalle->total;
        $factura->total_factura = $factura->sub_total - $factura->descuento;
        $factura->save();

        $detalle->delete();

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }


    public function realizarPedido(Request $request)
    {
        // Obtener la factura pendiente del vendedor actual
        $user_id = auth()->id();
        $factura = Factura::where('user_id', $user_id)
            ->where('estado_factura', 'pendiente')
            ->first();

        if (!$factura) {
            return redirect()->route('vendedor.productos.index')->with('error', 'No se encontró una factura pendiente.');
        }

        // Actualizar el id_cliente en la factura
        $factura->id_cliente = $request->id_cliente; // Id del cliente que realiza la compra
        $factura->save();

        // Obtener detalles de la factura agrupados por producto
        $detalles = DetalleFactura::where('id_factura', $factura->id_factura)->get();

        // Marcar la factura como completada (cambiar estado_factura a 'pagada' por ejemplo)
        $factura->estado_factura = 'pagada';
        $factura->save();

        // Mostrar una vista con el resumen del pedido
        return view('vendedor.layouts.resumen_pedido', compact('factura', 'detalles'));
    }

    public function listarPedidos(Request $request)
    {
        $user_id = auth()->id();
        $search = $request->input('search');
    
        $facturas = Factura::where('user_id', $user_id)
            ->where(function ($q) use ($search) {
                $q->where('id_cliente', 'like', "%{$search}%")
                  ->orWhere('nit', 'like', "%{$search}%")
                  ->orWhere('fecha', 'like', "%{$search}%");
            })
            ->get();
    
        return view('vendedor.layouts.pedidos', compact('facturas', 'search'));
    }

    public function show($id_factura)
    {
        $factura = Factura::findOrFail($id_factura);
        $detalles = DetalleFactura::where('id_factura', $id_factura)->with('producto')->get();

        return view('vendedor.layouts.show', compact('factura', 'detalles'));
    }
}
