<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Factura;

class VendedorFacturaController extends Controller
{
    public function index()
    {
        // Obtener todas las facturas del vendedor actual
        $id_vendedor = auth()->id();
        $facturas = Factura::where('id_vendedor', $id_vendedor)->get();

        return view('vendedor.facturas.index', compact('facturas'));
    }

    public function show($id_factura)
    {
        // Obtener detalles de una factura específica
        $factura = Factura::findOrFail($id_factura);

        // Aquí puedes obtener los detalles asociados a esta factura, si es necesario
        $detalles = $factura->detalles;

        return view('vendedor.facturas.show', compact('factura', 'detalles'));
    }

    // Otros métodos del controlador según necesidad (como edit, update, etc.)
}
