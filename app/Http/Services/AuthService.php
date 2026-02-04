<?php

namespace App\Http\Services;

use App\Http\Repository\AuthRepository;

class AuthService
{
    private $AuthRepository;

    public function __construct(AuthRepository $AuthRepository)
    {
        $this->AuthRepository = $AuthRepository;
    }

    public function login($email, $password)
    {
        return $this->AuthRepository->login($email, $password);
    }

//    public function logout()
//    {
//        session()->flush();
//    }
}
