<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;

use App\Models\LCliente;
use Illuminate\Http\Request;

class LClienteController extends Controller
{
    public function index()
    {
        $clientes = LCliente::paginate(10);
        return view('vendedor.lclientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('vendedor.lclientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'celular' => 'required|string|max:20',
            'correo' => 'required|string|email|max:255|unique:lclientes',
        ]);

        LCliente::create($request->all());

        return redirect()->route('vendedor.lclientes.index')->with('success', 'Cliente creado exitosamente.');
    }

    public function show($id)
    {
        $cliente = LCliente::findOrFail($id);
        return view('vendedor.lclientes.show', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = LCliente::findOrFail($id);
        return view('vendedor.lclientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'celular' => 'required|string|max:20',
            'correo' => 'required|string|email|max:255|unique:lclientes,correo,' . $id . ',id_lcliente',
        ]);

        $cliente = LCliente::findOrFail($id);
        $cliente->update($request->all());

        return redirect()->route('vendedor.lclientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $cliente = LCliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('vendedor.lclientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
