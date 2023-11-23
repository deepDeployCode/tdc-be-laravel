<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait AuthUserRepositories
{
    public function loginRepositories($request)
    {
    }

    public function registerRepositories($request)
    {
        try {
            $regisOnly = $request->only('name', 'email', 'password');
            $regisOnly['password'] = Hash::make($request->password);
            return User::create($regisOnly);
        } catch (\Exception $error) {
            return $error;
        }
    }

    public function logoutRepositories($request)
    {
    }
}
