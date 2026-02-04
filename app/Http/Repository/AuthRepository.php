<?php

namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function login($email, $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return null;
        }

        if (!\Illuminate\Support\Facades\Hash::check($password, $user->password)) {
            return null;
        }

        return $user;
    }
}
