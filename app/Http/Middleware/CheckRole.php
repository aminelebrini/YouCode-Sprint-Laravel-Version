<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Kan-checkiw l-Session dyalna lli 7etina f l-AuthController
        if (strtolower(session('user_role')) === strtolower($role)) {
            return $next($request);
        }

        // Ila makanch m-connecti, kireddu l-login
        return redirect()->route('login')->withErrors(['login' => 'Veuillez vous connecter.']);
    }
}
