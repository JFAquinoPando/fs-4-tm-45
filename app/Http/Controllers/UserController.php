<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of users (Leer).
     */
    public function index()
    {
        $usuarios = User::with('tareas')->orderBy('id', 'desc')->get();
        return view('usuario.index', compact('usuarios'));
    }

    /**
     * Show form to create a new user.
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created user (Crear).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/usuarios')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Show form to edit a user.
     */
    public function edit(User $usuario)
    {
        return view('usuario.edit', compact('usuario'));
    }

    /**
     * Update user in storage (Actualizar).
     */
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $usuario->name = $request->name;
        $usuario->email = $request->email;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect('/usuarios')->with('success', 'Usuario actualizado correctamente.');
    }

    // destroy no se implementa según requerimientos
}
