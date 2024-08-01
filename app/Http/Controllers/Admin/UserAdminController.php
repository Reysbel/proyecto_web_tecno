<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.tablas.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tablas.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:100|unique:users',
            'role' => 'required|in:admin,vendedor,cliente',
            'status' => 'required|in:active,inactive',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->password = Hash::make($request->password);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $user->image = "uploads/" . $imageName;
        }

        $user->save();

        return redirect()->route('admin.tablas.user.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.tablas.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.tablas.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:100|unique:users,email,' . $id,
            'role' => 'required|in:admin,vendedor,cliente',
            'status' => 'required|in:active,inactive',
            'password' => 'nullable|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $user->image = "uploads/" . $imageName;
        }

        $user->save();

        return redirect()->route('admin.tablas.user.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (File::exists(public_path($user->image))) {
            File::delete(public_path($user->image));
        }
        $user->delete();
        return redirect()->route('admin.tablas.user.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        $users = User::where('name', 'like', '%' . $q . '%')->orWhere('username', 'like', '%' . $q . '%')->get();
        return view('admin.tablas.user.index', compact('users'));
    }
}
