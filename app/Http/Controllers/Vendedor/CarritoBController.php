<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\DetalleFactura;
use App\Models\Factura;
use App\Models\LCliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CarritoBController extends Controller
{
    public function index()
    {
        $productos = Producto::orderBy('id_categoria')->get();
        $productosPorCategoria = $productos->groupBy('id_categoria');
        $categorias = Categoria::all();
        $lclientes = LCliente::all();
        $carrito = Session::get('carrito', []);
        
        foreach ($carrito as &$detalle) {
            if (!isset($detalle['total'])) {
                $detalle['total'] = $detalle['cantidad'] * $detalle['producto']->total_venta;
            }
        }
        unset($detalle);

        $total_carrito = array_sum(array_column($carrito, 'total'));

        return view('vendedor.carrito.index', compact('productos', 'productosPorCategoria', 'categorias', 'lclientes', 'carrito', 'total_carrito'));
    }

    public function agregarAlCarrito(Request $request, $id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        $carrito = Session::get('carrito', []);

        if (isset($carrito[$id_producto])) {
            $carrito[$id_producto]['cantidad']++;
        } else {
            $carrito[$id_producto] = [
                'producto' => $producto,
                'cantidad' => 1,
            ];
        }
        
        $carrito[$id_producto]['total'] = $carrito[$id_producto]['cantidad'] * $producto->total_venta;

        Session::put('carrito', $carrito);

        return redirect()->route('vendedor.carrito.index');
    }

    public function actualizarCantidad(Request $request, $id_producto)
    {
        $carrito = Session::get('carrito', []);

        if (isset($carrito[$id_producto])) {
            $producto = $carrito[$id_producto]['producto'];
            $cantidad = (int)$request->input('cantidad');

            if ($cantidad > 0) {
                $carrito[$id_producto]['cantidad'] = $cantidad;
                $carrito[$id_producto]['total'] = $cantidad * $producto->total_venta;
                Session::put('carrito', $carrito);
            } else {
                return redirect()->back()->with('error', 'La cantidad debe ser mayor que cero.');
            }
        }

        return redirect()->route('vendedor.carrito.index');
    }

    public function eliminarDelCarrito($id_producto)
    {
        $carrito = Session::get('carrito', []);

        if (isset($carrito[$id_producto])) {
            unset($carrito[$id_producto]);
        }

        Session::put('carrito', $carrito);

        return redirect()->route('vendedor.carrito.index');
    }

    public function cancelarCompra()
    {
        Session::forget('carrito');

        return redirect()->route('vendedor.carrito.index');
    }

    public function realizarPedido(Request $request)
    {
        $carrito = Session::get('carrito', []);

        foreach ($carrito as &$detalle) {
            if (!isset($detalle['total'])) {
                $detalle['total'] = $detalle['cantidad'] * $detalle['producto']->total_venta;
            }
        }
        unset($detalle);

        $sub_total = array_sum(array_column($carrito, 'total'));
        $descuento = $request->input('descuento', 0);
        $total_factura = $sub_total - ($sub_total * $descuento / 100);

        $user_id = Auth::id();

        DB::beginTransaction();

        try {
            $lcliente = new LCliente();
            $lcliente->nombre = $request->input('nombre');
            if ($request->input('metodo_pago') !== 'efectivo') {
                $lcliente->celular = $request->input('celular');
                $lcliente->correo = $request->input('correo');
            }
            $lcliente->save();

            $factura = new Factura();
            $factura->fecha = now();
            $factura->hora = now();
            $factura->sub_total = $sub_total;
            $factura->descuento = $descuento;
            $factura->total_factura = $total_factura;
            $factura->nit = $request->input('nit');
            $factura->user_id = $user_id;
            $factura->estado_factura = 'pendiente';
            $factura->metodo_pago = $request->input('metodo_pago');
            $factura->id_lcliente = $lcliente->id_lcliente;
            $factura->save();

            foreach ($carrito as $id_producto => $detalle) {
                $detallefactura = new DetalleFactura();
                $detallefactura->id_factura = $factura->id_factura;
                $detallefactura->id_producto = $id_producto;
                $detallefactura->cantidad = $detalle['cantidad'];
                $detallefactura->total = $detalle['total'];
                $detallefactura->save();
            }

            DB::commit();

            Session::forget('carrito');
            Session::put('factura', $factura);
            Session::put('detalle_factura', $carrito);

            return redirect()->route('vendedor.carrito.show');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Error al procesar el pedido: ' . $e->getMessage()]);
        }
    }

    public function resumenPedido()
    {
        $factura = Session::get('factura');
        if ($factura) {
            $factura->lcliente = LCliente::find($factura->id_lcliente);
        }
        $detalle_factura = Session::get('detalle_factura');

        return view('vendedor.carrito.show', compact('factura', 'detalle_factura'));
    }

    public function nuevoPedido()
    {
        Session::forget('carrito');
        return redirect()->route('vendedor.carrito.index');
    }
}
