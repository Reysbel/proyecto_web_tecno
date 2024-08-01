<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ClienteProfileController extends Controller
{
    public function index()
    {
        return view('cliente.profile.index');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . Auth::user()->id],
            'phone' => ['required', 'string', 'max:15'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
            'image' => ['image', 'max:2048'],
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            if (File::exists(public_path($user->image)) && $user->image != 'uploads/avatar.png') {
                File::delete(public_path($user->image));
            }

            $image = $request->file('image');
            $imageName = rand() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $path = "uploads/" . $imageName;

            $user->image = $path;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        toastr()->success('Sus datos se han actualizado correctamente.', 'Notification');

        return redirect()->route('cliente.profile');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            toastr()->error('La nueva contraseña no puede ser igual a la contraseña actual.', 'Notification');
            return redirect()->back();
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        toastr()->success('La contraseña se ha actualizado correctamente.', 'Notification');

        return redirect()->back();
    }
}
