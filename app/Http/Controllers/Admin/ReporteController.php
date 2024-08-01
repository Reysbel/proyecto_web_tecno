<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reporte;
use App\Models\Factura;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\PDF;

class ReporteController extends Controller
{
    public function index()
    {
        $reportes = Reporte::paginate(10);
        return view('admin.tablas.reporte.index', compact('reportes'));
    }

    public function create()
    {
        return view('admin.tablas.reporte.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date',
            'total_caja' => 'required|numeric',
            'ingreso' => 'required|numeric',
            'egreso' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['fecha'] = now();
        $data['user_id'] = Auth::id();

        Reporte::create($data);

        return redirect()->route('admin.tablas.reporte.index')->with('success', 'Reporte creado exitosamente.');
    }

    public function show($id)
    {
        $reporte = Reporte::findOrFail($id);
        return view('admin.tablas.reporte.show', compact('reporte'));
    }

    public function edit($id)
    {
        $reporte = Reporte::findOrFail($id);
        return view('admin.tablas.reporte.edit', compact('reporte'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'total_caja' => 'required|numeric',
            'ingreso' => 'required|numeric',
            'egreso' => 'required|numeric',
        ]);

        $reporte = Reporte::findOrFail($id);
        $reporte->update($request->all());

        return redirect()->route('admin.tablas.reporte.index')->with('success', 'Reporte actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $reporte = Reporte::findOrFail($id);
        $reporte->delete();

        return redirect()->route('admin.tablas.reporte.index')->with('success', 'Reporte eliminado exitosamente.');
    }

    public function obtenerDetalles(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date',
        ]);

        $fechaInicio = $request->query('fecha_inicio');
        $fechaFinal = $request->query('fecha_final');

        $ingresos = Factura::whereBetween('fecha', [$fechaInicio, $fechaFinal])->get();
        $egresos = Compra::whereBetween('fecha', [$fechaInicio, $fechaFinal])->get();

        return response()->json([
            'ingresos' => $ingresos->map(function ($ingreso) {
                return [
                    'id_factura' => $ingreso->id_factura,
                    'fecha' => $ingreso->fecha,
                    'total_factura' => $ingreso->total_factura,
                ];
            }),
            'egresos' => $egresos->map(function ($egreso) {
                return [
                    'id_compra' => $egreso->id_compra,
                    'fecha' => $egreso->fecha,
                    'total_compra' => $egreso->total_compra,
                ];
            }),
        ]);
    }
    public function print($id)
    {
        $reporte = Reporte::findOrFail($id);

        // Generar el PDF
        $pdf = PDF::loadView('admin.tablas.reporte.pdf', compact('reporte'));

        // Descargar el PDF
        return $pdf->download('reporte.pdf');
    }
}