<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     // Affiche la vue de connexion
     public function loginForm()
     {
         return view('auth.login');
     }
 
     // Affiche la vue d'inscription
     public function registerForm()
     {
         return view('auth.register');
     }

      // Inscription d'un utilisateur
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user',
        ]);

        return redirect()->route('login')->with('success', 'Inscription réussie. Connectez-vous.');
    }

    
    // Connexion d'un utilisateur
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['user' => $user]);

            return redirect()->route($user->role == 'admin' ? 'admin.dashboard' : 'user.dashboard');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    // Déconnexion d'un utilisateur
    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login')->with('success', 'Déconnecté avec succès.');
    }
}
