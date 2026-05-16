<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
class UsuarioController extends Controller
{
    ///logica de negocio del modulo
    public function index(): View {
        return view('usuarios.index');
    }
}
