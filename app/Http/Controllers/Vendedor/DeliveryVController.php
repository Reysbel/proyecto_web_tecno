<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryVController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $deliverys = Delivery::query()
            ->where('nombre_apellido', 'like', "%{$search}%")
            ->orWhere('placa', 'like', "%{$search}%")
            ->get();

        return view('vendedor.delivery.index', compact('deliverys', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_apellido' => 'required|string|max:255',
            'placa' => 'required|string|max:255|unique:deliverys,placa',
            'telefono' => 'nullable|string|max:20',
        ]);

        Delivery::create($request->all());

        return redirect()->route('vendedor.delivery.index')->with('success', 'Delivery creado exitosamente.');
    }

    public function edit($id)
    {
        $delivery = Delivery::findOrFail($id);
        return view('vendedor.delivery.edit', compact('delivery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_apellido' => 'required|string|max:255',
            'placa' => 'required|string|max:255|unique:deliverys,placa,' . $id . ',id_delivery',
            'telefono' => 'nullable|string|max:20',
        ]);

        $delivery = Delivery::findOrFail($id);
        $delivery->update($request->all());

        return redirect()->route('vendedor.delivery.index')->with('success', 'Delivery actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->delete();

        return redirect()->route('vendedor.delivery.index')->with('success', 'Delivery eliminado exitosamente.');
    }

    public function show($id)
    {
        $delivery = Delivery::findOrFail($id);
        return view('vendedor.delivery.show', compact('delivery'));
    }
}
