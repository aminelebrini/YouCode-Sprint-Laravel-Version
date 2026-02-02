<?php

namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function login($email, $password) {
        $user = User::where('email', $email)->first();

        // Debug sghir:
        if ($user && \Hash::check($password, $user->password)) {
            return $user;
        }

        return null;
    }
}
