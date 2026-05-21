<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;

class UsuarioController extends Controller
{
    ///logica de negocio del modulo
    public function index(): View {

        $usuarios = User::with('roles')->latest()->paginate(10);

        return view('usuarios.index', compact('usuarios'));
    }
    public function create(): View{

        $roles = Role::orderBy('name')->get();
        //dd($roles->all());
        return view('usuarios.create',compact('roles'));
    }
    public function store(Request $request): RedirectResponse
    {
        //dd($request->all());
        $datos = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed','min:8'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'direccion' => ['nullable', 'string'],
            'foto' => ['nullable', 'string'],
            'estado' => ['required','boolean'],
            'role' => ['required', 'exists:roles,name'],
        ]);
        $user = User::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'password' => $datos['password'],
            'telefono' => $datos['telefono'],
            'direccion' => $datos['direccion'],
            'foto' => $datos['foto'],
            'estado' => $datos['estado'],
        ]);

        $user->assignRole($datos['role']);

        return redirect()
            ->route('usuarios.index')
            ->with('success','Usuario creado correctamente.');
    }

    public function show(User $user): View
    {
        $user->load('roles');

        return view('usuarios.show', compact('user'));
    }

}
