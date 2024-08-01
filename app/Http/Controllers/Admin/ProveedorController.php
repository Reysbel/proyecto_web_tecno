<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $proveedores = Proveedor::query()
            ->where('encargado', 'like', "%{$search}%")
            ->orWhere('editorial', 'like', "%{$search}%")
            ->get();

        return view('admin.tablas.proveedor.index', compact('proveedores', 'search'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tablas.proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'encargado' => 'required|string|max:100',
            'editorial' => 'required|string|max:100',
            'ci' => 'nullable|string|max:20',
            'telefono' => 'required|string|max:20',
            'correo' => 'nullable|string|email|max:100',
            'direccion' => 'nullable|string|max:255',
            'estado' => 'required|in:activo,inactivo'
        ]);

        $proveedor = new Proveedor();
        $proveedor->encargado = $request->encargado;
        $proveedor->editorial = $request->editorial;
        $proveedor->ci = $request->ci;
        $proveedor->telefono = $request->telefono;
        $proveedor->correo = $request->correo;
        $proveedor->direccion = $request->direccion;
        $proveedor->estado = $request->estado;
        $proveedor->save();

        return redirect()->route('admin.tablas.proveedor.index')
            ->with('success', 'Proveedor creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('admin.tablas.proveedor.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('admin.tablas.proveedor.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $request->validate([
            'encargado' => 'required|string|max:100',
            'editorial' => 'required|string|max:100',
            'ci' => 'nullable|string|max:20',
            'telefono' => 'required|string|max:20',
            'correo' => 'nullable|string|email|max:100',
            'direccion' => 'nullable|string|max:255',
            'estado' => 'required|in:activo,inactivo'
        ]);

        $proveedor->encargado = $request->encargado;
        $proveedor->editorial = $request->editorial;
        $proveedor->ci = $request->ci;
        $proveedor->telefono = $request->telefono;
        $proveedor->correo = $request->correo;
        $proveedor->direccion = $request->direccion;
        $proveedor->estado = $request->estado;
        $proveedor->save();

        return redirect()->route('admin.tablas.proveedor.index')
            ->with('success', 'Proveedor actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return redirect()->route('admin.tablas.proveedor.index')
            ->with('success', 'Proveedor eliminado exitosamente.');
    }
}
