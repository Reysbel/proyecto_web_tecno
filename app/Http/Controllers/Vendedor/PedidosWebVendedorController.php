<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PedidoWeb;
use App\Models\Factura;
use App\Models\Delivery;
use App\Models\User;

class PedidosWebVendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
     {
         $pedidos = PedidoWeb::orderBy('id_pedido', 'desc')->get();
         $categorias = [
             'TODOS' => $pedidos,
             'NUEVOS' => $pedidos->where('pedido_estado', 'procesando'),
             'ACEPTADOS' => $pedidos->where('pedido_estado', 'pedido aceptado'),
             'ENVIADOS' => $pedidos->where('pedido_estado', 'enviado'),
             'ENTREGADOS' => $pedidos->where('pedido_estado', 'entregado'),
             'NO ENTREGADOS' => $pedidos->where('pedido_estado', 'no entregado'),
         ];
     
         return view('vendedor.pedidoweb.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facturas = Factura::all();
        $deliveries = Delivery::all();
        $users = User::all();

        return view('vendedor.pedidoweb.create', compact('facturas', 'deliveries', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_pedido)
{
    $pedido = PedidoWeb::with(['factura.cliente', 'factura.detalles.producto'])->findOrFail($id_pedido);
    return view('vendedor.pedidoweb.show', compact('pedido'));
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = PedidoWeb::findOrFail($id);
        $facturas = Factura::all();
        $deliveries = Delivery::all();
        $users = User::all();

        return view('vendedor.pedidoweb.edit', compact('pedido', 'facturas', 'deliveries', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_pedido)
    {
        // Encontrar el pedido web por su ID
        $pedido = PedidoWeb::findOrFail($id_pedido);

        // Actualizar los datos del pedido web
        $pedido->tiempo_demora = $request->input('tiempo_demora');
        $pedido->pedido_estado = $request->input('pedido_estado');

        // Si existe el campo 'id_delivery' en la solicitud, asignarlo al pedido
        if ($request->has('id_delivery')) {
            $pedido->id_delivery = $request->input('id_delivery');
        }

        // Actualizar el estado de la factura relacionada
        $pedido->factura->estado_factura = $request->input('estado_factura');

        // Guardar los cambios en el pedido y la factura
        $pedido->save();
        $pedido->factura->save();

        // Redirigir a la vista index con un mensaje de éxito
        return redirect()->route('vendedor.pedidoweb.index')->with('success', 'Pedido actualizado correctamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = PedidoWeb::findOrFail($id);
        $pedido->delete();

        return redirect()->route('vendedor.pedidoweb.index')
            ->with('success', 'Pedido web eliminado correctamente.');
    }
}
