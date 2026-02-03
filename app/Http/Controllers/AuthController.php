<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Services\AuthService;

class AuthController extends Controller
{
    private $AuthService;

    public function __construct(AuthService $AuthService)
    {
        $this->AuthService = $AuthService;
    }

    public function show()
    {
        return view('home');
    }

    public function login(Request $request)
    {
        $user = $this->AuthService->login($request->email, $request->password);

        if (!$user) {
            return back()->withErrors(['email' => 'Identifiants incorrects']);
        }

        Auth::login($user);
//        dd($user);
        session([
            'user_id'    => $user->id,
            'user_role'  => $user->role,
            'firstname'  => $user->firstname,
            'lastname'   => $user->lastname,
            'is_logged'  => true
        ]);

        if ($user->role === 'admin') return redirect()->route('admindash');
        if ($user->role === 'Formateur') return redirect()->route('formateurdash');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
