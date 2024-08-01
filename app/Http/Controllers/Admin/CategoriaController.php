<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categorias = Categoria::query()
            ->where('nombre', 'like', "%{$search}%")
            ->get();

        return view('admin.tablas.categoria.index', compact('categorias', 'search'));
    }
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tablas.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'imagen' => 'nullable|image|max:2048', // Cambiado a 'image' y límite de tamaño

            // Agrega otras reglas de validación para tus campos aquí si es necesario
        ]);

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;

        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $categoria->imagen = "uploads/" . $imageName;
        }

        $categoria->save();

        return redirect()->route('admin.tablas.categoria.index')
            ->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.tablas.categoria.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.tablas.categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'imagen' => 'nullable|image|max:2048', // Cambiado a 'image' y límite de tamaño

            // Agrega otras reglas de validación para tus campos aquí si es necesario
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior
            if (File::exists(public_path($categoria->imagen))) {
                File::delete(public_path($categoria->imagen));
            }

            $image = $request->file('imagen');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $categoria->imagen = "uploads/" . $imageName;
        }

        $categoria->nombre = $request->nombre;
        $categoria->save();

        return redirect()->route('admin.tablas.categoria.index')
            ->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);

        if (File::exists(public_path($categoria->imagen))) {
            File::delete(public_path($categoria->imagen));
        }

        $categoria->delete();

        return redirect()->route('admin.tablas.categoria.index')
            ->with('success', 'Categoría eliminada exitosamente.');
    }

    /**
     * Search for a specific resource.
     */
    public function search(Request $request)
    {
        $q = $request->input('q');
        $categorias = Categoria::where('nombre', 'like', '%' . $q . '%')->get();
        return view('admin.tablas.categoria.index', compact('categorias'));
    }
}
