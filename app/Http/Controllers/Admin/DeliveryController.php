<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        if ($query) {
            $deliverys = Delivery::where('nombre_apellido', 'like', "%$query%")
                ->orWhere('placa', 'like', "%$query%")
                ->orWhere('telefono', 'like', "%$query%")
                ->get();
        } else {
            $deliverys = Delivery::all();
        }
        
        return view('admin.tablas.delivery.index', compact('deliverys'));
    }

    public function create()
    {
        return view('admin.tablas.delivery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_apellido' => 'required|string|max:255',
            'placa' => 'required|string|max:255|unique:deliverys',
            'telefono' => 'nullable|string|max:255',
            'ci' => 'nullable|string|max:255',
        ]);

        Delivery::create($request->all());

        return redirect()->route('admin.tablas.delivery.index')
                         ->with('success', 'Delivery created successfully.');
    }

    public function show($id)
    {
        $delivery = Delivery::findOrFail($id);
        return view('admin.tablas.delivery.show', compact('delivery'));
    }

    public function edit($id)
    {
        $delivery = Delivery::findOrFail($id);
        return view('admin.tablas.delivery.edit', compact('delivery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_apellido' => 'required|string|max:255',
            'placa' => 'required|string|max:255|unique:deliverys,placa,' . $id . ',id_delivery',
            'telefono' => 'nullable|string|max:255',
        ]);

        $delivery = Delivery::findOrFail($id);
        $delivery->update($request->all());

        return redirect()->route('admin.tablas.delivery.index')
                         ->with('success', 'Delivery updated successfully.');
    }

    public function destroy($id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->delete();

        return redirect()->route('admin.tablas.delivery.index')
                         ->with('success', 'Delivery deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $deliverys = Delivery::where('nombre_apellido', 'LIKE', "%{$query}%")
                             ->orWhere('placa', 'LIKE', "%{$query}%")
                             ->get();

        return view('admin.tablas.delivery.search', compact('deliverys'));
    }
}
