<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $compras = Compra::query()
            ->where('nit_recibo', 'like', "%{$search}%")
            ->orWhereHas('proveedor', function ($query) use ($search) {
                $query->where('encargado', 'like', "%{$search}%")
                    ->orWhere('editorial', 'like', "%{$search}%");
            })
            ->get();

        return view('admin.tablas.compra.index', compact('compras', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        return view('admin.tablas.compra.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nit_recibo' => 'nullable|string|max:20',
            'total_compra' => 'required|numeric',
            'id_proveedor' => 'required|exists:proveedores,id_proveedor',
        ]);

        $compra = new Compra();
        $compra->nit_recibo = $request->nit_recibo;
        $compra->fecha = now(); // Fecha actual
        $compra->total_compra = $request->total_compra;
        $compra->id_proveedor = $request->id_proveedor;
        $compra->user_id = auth()->id(); // Usuario autenticado
        $compra->save();

        foreach ($request->productos as $id_producto => $detalle) {
            $producto = Producto::find($id_producto);
            $producto->stock += $detalle['cantidad']; // Actualizar stock
            $producto->save();

            DetalleCompra::create([
                'cantidad' => $detalle['cantidad'],
                'total' => $detalle['cantidad'] * $detalle['precio_compra'],
                'id_producto' => $id_producto,
                'id_compra' => $compra->id_compra,
            ]);
        }

        return redirect()->route('admin.tablas.compra.index')
            ->with('success', 'Compra creada exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $compra = Compra::findOrFail($id);
        return view('admin.tablas.compra.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $compra = Compra::findOrFail($id);
        $proveedores = Proveedor::all();
        return view('admin.tablas.compra.edit', compact('compra', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $compra = Compra::findOrFail($id);

        $request->validate([
            'nit_recibo' => 'nullable|string|max:20',
            'fecha' => 'required|date',
            'total_compra' => 'required|numeric',
            'id_proveedor' => 'nullable|exists:proveedores,id_proveedor',
            'user_id' => 'required|exists:users,id'
        ]);

        $compra->nit_recibo = $request->nit_recibo;
        $compra->fecha = $request->fecha;
        $compra->total_compra = $request->total_compra;
        $compra->id_proveedor = $request->id_proveedor;
        $compra->user_id = $request->user_id;
        $compra->save();

        return redirect()->route('admin.tablas.compra.index')
            ->with('success', 'Compra actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $compra = Compra::findOrFail($id);
        $compra->delete();
        return redirect()->route('admin.tablas.compra.index')
            ->with('success', 'Compra eliminada exitosamente.');
    }
    public function main()
    {
        return view('admin.tablas.compra.main');
    }
}
