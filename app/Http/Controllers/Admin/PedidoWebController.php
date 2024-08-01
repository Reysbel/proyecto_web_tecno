<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PedidoWeb;
use Illuminate\Http\Request;
use App\Events\PedidoWebCreated;
use App\Models\Factura;

class PedidoWebController extends Controller
{
    /**
     * Muestra una lista de pedidos web.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        if ($query) {
            $pedidos = PedidoWeb::where('ubicacion', 'like', "%$query%")
                ->orWhere('referencia_ubicacion', 'like', "%$query%")
                ->orWhere('pedido_estado', 'like', "%$query%")
                ->get();
        } else {
            $pedidos = PedidoWeb::all();
        }

        return view('admin.tablas.pedido_web.index', compact('pedidos'));
    }

    /**
     * Muestra los detalles de un pedido web específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = PedidoWeb::findOrFail($id);
        $factura = Factura::with('detalles.producto')->findOrFail($pedido->id_factura);
        return view('admin.tablas.pedido_web.show', compact('pedido', 'factura'));
    }
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'ubicacion' => 'nullable|string|max:255',
            'referencia_ubicacion' => 'nullable|string|max:255',
            'telefono_referencia' => 'nullable|string|max:20',
            'tiempo_demora' => 'required|date_format:H:i',
            'nota' => 'nullable|string',
            'pedido' => 'required|in:domicilio,local', // Asegúrate de que este campo esté siendo validado y no sea nulo
            'id_factura' => 'required|exists:facturas,id_factura',
            'id_delivery' => 'nullable|exists:deliverys,id_delivery',
        ]);

        // Crear una instancia del modelo PedidoWeb con los datos del formulario
        $pedido = new PedidoWeb();
        $pedido->ubicacion = $request->ubicacion;
        $pedido->referencia_ubicacion = $request->referencia_ubicacion;
        $pedido->telefono_referencia = $request->telefono_referencia;
        $pedido->tiempo_demora = $request->tiempo_demora;
        $pedido->nota = $request->nota;
        $pedido->pedido = $request->pedido; // Asegúrate de que este valor se esté asignando correctamente
        $pedido->pedido_estado = 'procesando';
        $pedido->id_factura = $request->id_factura;
        $pedido->id_delivery = $request->id_delivery; // Este puede ser nulo si no se proporciona
        $pedido->user_id = auth()->id();
        $pedido->save();

        // Disparar el evento PedidoWebCreated para notificar a los administradores
        event(new PedidoWebCreated($pedido));

        // Redirige o devuelve una respuesta según tu lógica de aplicación
        return redirect()->route('admin.tablas.pedido_web.index')->with('success', 'Pedido realizado correctamente.');
    }
}
