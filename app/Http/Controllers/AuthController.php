<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\AuthService;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function show()
    {
        return view('home');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = $this->authService->login(
            $request->email,
            $request->password
        );

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email ou mot de passe incorrect'
            ]);
        }

        Auth::login($user);                    
        $request->session()->regenerate();     

//        dd(Auth::user());

        if ($user->role === 'admin') {
            return redirect()->route('admindash');
        }

        if ($user->role === 'formateur') {
            return redirect()->route('formateurdash');
        }

        if ($user->role === 'etudiant') {
            return redirect()->route('etudiantdash');
        }

        Auth::logout();
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
