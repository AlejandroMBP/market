<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(): View {
        return view('roles.index');
    }
    public function create(): View{
        $permissions = Permission::orderBy('name')->get();
        return view('roles.create', compact('permissions'));
    }
}
