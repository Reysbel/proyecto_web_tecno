<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Promocion;
use App\Models\Producto;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $promociones = Promocion::where('nombre', 'like', "%$search%")
            ->orWhere('descripcion', 'like', "%$search%")
            ->paginate(10);

        return view('admin.tablas.promocion.index', compact('promociones', 'search'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('admin.tablas.promocion.create', compact('productos'));
    }

    public function show($id)
{
    $promocion = Promocion::findOrFail($id);
    // Asegúrate de que las fechas sean objetos Carbon si las necesitas formatear en la vista
    $promocion->fecha_inicio = \Carbon\Carbon::parse($promocion->fecha_inicio);
    $promocion->fecha_fin = \Carbon\Carbon::parse($promocion->fecha_fin);
    
    return view('admin.tablas.promocion.show', compact('promocion'));
}

    public function edit($id)
    {
        $promocion = Promocion::findOrFail($id);
        $productos = Producto::all();
        return view('admin.tablas.promocion.edit', compact('promocion', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_producto' => 'required',
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'descuento' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $promocion = Promocion::findOrFail($id);
        $promocion->update($request->all());

        return redirect()->route('admin.tablas.promocion.index')->with('success', 'Promoción actualizada exitosamente.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required',
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'descuento' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
    
        Promocion::create($request->all());
    
        return redirect()->route('admin.tablas.promocion.index')->with('success', 'Promoción creada exitosamente.');
    }
    
    public function destroy($id)
    {
        $promocion = Promocion::findOrFail($id);
        $promocion->delete();

        return redirect()->route('admin.tablas.promocion.index')->with('success', 'Promoción eliminada exitosamente.');
    }
}
