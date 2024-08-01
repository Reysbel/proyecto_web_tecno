<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Factura;
use App\Models\DetalleFactura;
use App\Models\Producto;
use App\Models\User;
use App\Models\LCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    // Muestra el formulario para crear una nueva factura
    public function create()
    {
        $clientesWeb = User::where('role', 'cliente')->get(); // Obtener clientes web
        $clientesLocales = LCliente::all(); // Obtener clientes locales
        $productos = Producto::where('estado', 'activo')->get(); // Obtener productos activos

        return view('admin.tablas.factura.create', compact('clientesWeb', 'clientesLocales', 'productos'));
    }

    // Almacena una nueva factura en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'nullable|exists:users,id',
            'id_lcliente' => 'nullable|exists:lclientes,id_lcliente',
            'nit' => 'nullable|string',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'tipo_cliente' => 'required|in:local,web',
            'metodo_pago' => 'required|in:efectivo,pagofacil,tigomoney',
            'estado_factura' => 'required|in:pendiente,pagada,anulada',
            'pedido_estado' => 'required|in:procesando,enviado,entregado',
            'listo' => 'required|boolean',
            'productos.*.id_producto' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        // Crear la factura
        $factura = new Factura();
        $factura->user_id = auth()->id(); // Asignar el ID del usuario autenticado
        $factura->id_cliente = $request->input('id_cliente');
        $factura->id_lcliente = $request->input('id_lcliente');
        $factura->nit = $request->input('nit');
        $factura->fecha = $request->input('fecha');
        $factura->hora = $request->input('hora');
        $factura->tipo_cliente = $request->input('tipo_cliente');
        $factura->metodo_pago = $request->input('metodo_pago');
        $factura->estado_factura = $request->input('estado_factura');
        $factura->pedido_estado = $request->input('pedido_estado');
        $factura->listo = $request->input('listo');

        $factura->save();

        // Guardar los detalles de la factura
        $productos = $request->input('productos');
        foreach ($productos as $producto) {
            $detalleFactura = new DetalleFactura();
            $detalleFactura->cantidad = $producto['cantidad'];
            $detalleFactura->total = $producto['cantidad'] * $producto['precio_unitario'];
            $detalleFactura->id_producto = $producto['id_producto'];
            $detalleFactura->id_factura = $factura->id;

            $detalleFactura->save();
        }

        return redirect()->route('admin.tablas.factura.index')
            ->with('success', 'Factura creada correctamente.');
    }

    // Muestra una factura específica
    public function show($id)
    {
        $factura = Factura::findOrFail($id);
        return view('admin.tablas.factura.show', compact('factura'));
    }

    // Muestra el formulario para editar una factura
    public function edit($id)
    {
        $factura = Factura::findOrFail($id);
        $clientes = User::where('role', 'cliente')->get(); // Obtener clientes web
        $clientesLocales = LCliente::all(); // Obtener clientes locales

        return view('admin.tablas.factura.edit', compact('factura', 'clientes', 'clientesLocales'));
    }

    // Actualiza una factura específica en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_cliente' => 'nullable|exists:users,id',
            'id_lcliente' => 'nullable|exists:lclientes,id_lcliente',
            'nit' => 'nullable|string',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'sub_total' => 'required|numeric|min:0',
            'descuento' => 'nullable|numeric|min:0',
            'total_factura' => 'required|numeric|min:0',
            'tipo_moneda' => 'required|integer',
            'tipo_cliente' => 'required|in:local,web',
            'metodo_pago' => 'required|in:efectivo,pagofacil,tigomoney',
            'estado_factura' => 'required|in:pendiente,pagada,anulada',
            'pedido_estado' => 'required|in:procesando,enviado,entregado',
            'listo' => 'required|boolean',
        ]);

        // Buscar la factura por ID
        $factura = Factura::findOrFail($id);

        // Actualizar la factura
        $factura->id_cliente = $request->input('id_cliente');
        $factura->id_lcliente = $request->input('id_lcliente');
        $factura->nit = $request->input('nit');
        $factura->fecha = $request->input('fecha');
        $factura->hora = $request->input('hora');
        $factura->sub_total = $request->input('sub_total');
        $factura->descuento = $request->input('descuento');
        $factura->total_factura = $request->input('total_factura');
        $factura->tipo_moneda = $request->input('tipo_moneda');
        $factura->tipo_cliente = $request->input('tipo_cliente');
        $factura->metodo_pago = $request->input('metodo_pago');
        $factura->estado_factura = $request->input('estado_factura');
        $factura->pedido_estado = $request->input('pedido_estado');
        $factura->listo = $request->input('listo');

        $factura->save();

        return redirect()->route('admin.tablas.factura.index')
            ->with('success', 'Factura actualizada correctamente.');
    }

    // Elimina una factura específica de la base de datos
    public function destroy($id)
    {
        $factura = Factura::findOrFail($id);
        $factura->delete();

        return redirect()->route('admin.tablas.factura.index')
            ->with('success', 'Factura eliminada correctamente.');
    }
}
