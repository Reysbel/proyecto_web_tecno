<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function dashboard() {
        return view('cliente.dashboard');
    }

    public function login() {
        return view('cliente.auth.login');
    }
}

