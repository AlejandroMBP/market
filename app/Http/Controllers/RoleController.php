<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function index(): View {
        $roles = Role::withCount('permissions')->latest()->paginate(10);
        return view('roles.index', compact('roles'));
    }
    public function create(): View{
        $permissions = Permission::orderBy('name')->get();
        return view('roles.create', compact('permissions'));
    }
    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'name' => ['required','string','max:100', 'unique:roles,name'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ]);
        $role = Role::create([
            'name' => $datos['name'],
            'guard_name' => 'web',
        ]);

        $role->syncPermissions($datos['permissions'] ?? []);

        return redirect()->route('roles.index')->with('success','Rol creado correctamente.');
    }
    public function show(Role $role): View
    {
        $role->load('permissions');

        return view('roles.show', compact('role'));
    }
        public function edit(Role $role): View
    {
        $permissions = Permission::orderBy('name')->get();
        $role->load('permissions');

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->ignore($role->id)],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ]);

        $role->update(['name' => $datos['name']]);
        $role->syncPermissions($datos['permissions'] ?? []);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return redirect()
            ->route('roles.index');
    }
}
