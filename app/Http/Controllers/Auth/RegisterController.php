<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'numero_identificacion' => 'required|string|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'categoria' => 'required|in:Estudiante,Profesor',
        ]);

        $user = User::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'numero_identificacion' => $request->numero_identificacion,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'categoria' => $request->categoria,
            'activo' => $request->categoria === 'Estudiante',
        ]);

        auth()->login($user);

        return redirect()->route('home-two');
    }
}