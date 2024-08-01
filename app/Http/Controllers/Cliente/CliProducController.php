<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\DetalleFactura;
use App\Models\Factura;
use Illuminate\Http\Request;

class CliProducController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('cliente.layouts.index', compact('productos'));
    }

    public function agregarAlCarrito(Request $request, $id_producto)
    {
        $id_cliente = auth()->id();

        // Buscar factura pendiente para el cliente actual
        $factura = Factura::where('id_cliente', $id_cliente)
            ->where('estado_factura', 'pendiente')
            ->first();

        // Si no existe una factura pendiente, crear una nueva
        if (!$factura) {
            $factura = new Factura();
            $factura->user_id = 1; // Reemplaza con el ID del vendedor correspondiente
            $factura->id_cliente = $id_cliente;
            $factura->fecha = now();
            $factura->sub_total = 0;
            $factura->descuento = 0;
            $factura->total_factura = 0;
            $factura->metodo_pago = 'efectivo';
            $factura->estado_factura = 'pendiente';
            $factura->save();
        }

        // Agregar producto al detalle de la factura
        $detalleFactura = new DetalleFactura();
        $detalleFactura->id_producto = $id_producto;
        $detalleFactura->id_factura = $factura->id_factura;
        $detalleFactura->cantidad = 1; // Puedes ajustar la cantidad según tus necesidades
        $detalleFactura->total = Producto::find($id_producto)->precio; // Calcula el total basado en el precio del producto
        $detalleFactura->save();

        // Actualizar subtotal y total de la factura
        $factura->sub_total += $detalleFactura->total;
        $factura->total_factura = $factura->sub_total - $factura->descuento;
        $factura->save();

        // Redirigir de vuelta a la página anterior (donde se agregó el producto)
        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }

    public function verCarrito()
    {
        // Obtener la factura pendiente del cliente actual
        $factura = Factura::where('id_cliente', auth()->id())
            ->where('estado_factura', 'pendiente')
            ->first();

        if (!$factura) {
            return redirect()->route('cliente.layouts.index')->with('error', 'No hay productos en el carrito.');
        }

        // Agrupar los detalles por producto para evitar duplicados y contar la cantidad total
        $detalles_agrupados = $factura->detalles->groupBy('id_producto');
        $detalles = collect();

        foreach ($detalles_agrupados as $detalles_producto) {
            $primer_detalle = $detalles_producto->first();
            $total = $detalles_producto->sum('cantidad');
            $primer_detalle->cantidad = $total;
            $detalles->add($primer_detalle);
        }

        return view('cliente.layouts.carrito', compact('detalles', 'factura'));
    }

    public function realizarPedido(Request $request)
    {
        $id_cliente = auth()->id();

        // Obtener la factura pendiente del cliente actual
        $factura = Factura::where('id_cliente', $id_cliente)
            ->where('estado_factura', 'pendiente')
            ->first();

        if (!$factura) {
            return redirect()->route('cliente.layouts.index')->with('error', 'No se encontró una factura pendiente.');
        }

        // Marcar la factura como completada (cambiar estado_factura a 'pagada' por ejemplo)
        $factura->estado_factura = 'pagada';
        $factura->save();

        // Redirigir a la página principal de productos con mensaje de éxito
        return redirect()->route('cliente.layouts.index')->with('success', 'Pedido realizado correctamente.');
    }

    public function cancelarCompra(Request $request)
    {
        $id_cliente = auth()->id();

        // Obtener y eliminar la factura pendiente del cliente actual
        $factura = Factura::where('id_cliente', $id_cliente)
            ->where('estado_factura', 'pendiente')
            ->first();

        if ($factura) {
            // Eliminar los detalles de la factura si es necesario
            $factura->detalles()->delete();
            // Eliminar la factura
            $factura->delete();
        }

        // Redirigir a la página principal de productos con mensaje de éxito
        return redirect()->route('cliente.layouts.index')->with('success', 'Compra cancelada correctamente.');
    }

    public function listarPedidos()
    {
        $id_cliente = auth()->id();

        // Obtener todos los pedidos realizados por el cliente
        $pedidos = Factura::where('id_cliente', $id_cliente)
            ->where('estado_factura', '!=', 'pendiente') // Mostrar solo pedidos completados o anulados, ajusta según tu lógica
            ->orderByDesc('fecha')
            ->get();

        return view('cliente.layouts.pedidos', compact('pedidos'));
    }

    public function detalleFactura($id_factura)
    {
        // Obtener la factura por su ID
        $factura = Factura::findOrFail($id_factura);

        // Retornar la vista de detalle con la factura obtenida
        return view('cliente.layouts.detalle', compact('factura'));
    }

    public function eliminarDelCarrito($id_detalle)
    {
        // Encontrar el detalle de factura por su ID
        $detalle = DetalleFactura::findOrFail($id_detalle);

        // Eliminar el detalle de factura
        $detalle->delete();

        // Redirigir de vuelta a la página del carrito con un mensaje
        return redirect()->route('cliente.carrito.ver')->with('success', 'Producto eliminado del carrito correctamente.');
    }

    public function actualizarCantidad(Request $request, $id_detalle)
    {
        // Validar la solicitud
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        // Buscar el detalle de factura por su ID
        $detalle = DetalleFactura::findOrFail($id_detalle);

        // Actualizar la cantidad del producto en el carrito
        $detalle->cantidad = $request->cantidad;

        // Calcular el nuevo total basado en la nueva cantidad y el precio unitario del producto
        $detalle->total = $detalle->cantidad * $detalle->producto->precio;

        // Guardar los cambios en la base de datos
        $detalle->save();

        // Redirigir de vuelta a la página del carrito con un mensaje
        return redirect()->route('cliente.carrito.ver')->with('success', 'Cantidad actualizada correctamente.');
    }
}
