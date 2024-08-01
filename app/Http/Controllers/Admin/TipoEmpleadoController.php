<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoEmpleado;
use Illuminate\Http\Request;
use File;

class TipoEmpleadoController extends Controller
{
    public function index()
    {
        $tipoEmpleados = TipoEmpleado::all();
        return view('admin.tablas.tipo_empleado.index', compact('tipoEmpleados'));
    }

    public function create()
    {
        return view('admin.tablas.tipo_empleado.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $tipoEmpleado = new TipoEmpleado();
        $tipoEmpleado->tipo = $request->tipo;

        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $tipoEmpleado->imagen = "uploads/" . $imageName;
        }

        $tipoEmpleado->save();

        return redirect()->route('admin.tablas.tipo_empleado.index')
            ->with('success', 'Tipo de empleado creado exitosamente.');
    }

    public function show($id)
    {
        $tipoEmpleado = TipoEmpleado::findOrFail($id);
        return view('admin.tablas.tipo_empleado.show', compact('tipoEmpleado'));
    }

    public function edit($id)
    {
        $tipoEmpleado = TipoEmpleado::findOrFail($id);
        return view('admin.tablas.tipo_empleado.edit', compact('tipoEmpleado'));
    }

    public function update(Request $request, $id)
    {
        $tipoEmpleado = TipoEmpleado::findOrFail($id);

        $request->validate([
            'tipo' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $tipoEmpleado->tipo = $request->tipo;

        if ($request->hasFile('imagen')) {
            if (File::exists(public_path($tipoEmpleado->imagen))) {
                File::delete(public_path($tipoEmpleado->imagen));
            }
            $image = $request->file('imagen');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $tipoEmpleado->imagen = "uploads/" . $imageName;
        }

        $tipoEmpleado->save();

        return redirect()->route('admin.tablas.tipo_empleado.index')
            ->with('success', 'Tipo de empleado actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $tipoEmpleado = TipoEmpleado::findOrFail($id);
        if (File::exists(public_path($tipoEmpleado->imagen))) {
            File::delete(public_path($tipoEmpleado->imagen));
        }
        $tipoEmpleado->delete();
        return redirect()->route('admin.tablas.tipo_empleado.index')
            ->with('success', 'Tipo de empleado eliminado exitosamente.');
    }
}
