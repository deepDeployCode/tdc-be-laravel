<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait AuthUserRepositories
{
    public function res()
    {
        return new Controller;
    }
    public function loginRepositories($request)
    {
        if (!$user = User::whereemail($request->email)->first()) return $this->res()->builder('failed login', 'email salah', 422);
        if (!Hash::check($request->password, $user->password)) return $this->res()->builder('failed login', 'password salah', 422);
        $res = $user;
        $res['token'] = $user->createToken('tdc-app')->accessToken;
        return $this->res()->builder($res, 'Successfully Login');
    }
    public function registerRepositories($request)
    {
        $regisOnly = $request->only('name', 'email', 'password');
        $regisOnly['password'] = Hash::make($request->password);
        return $this->res()->builder(User::create($regisOnly), 'Successfully Register');
    }
    public function logoutRepositories()
    {
        $data = Auth::guard('api')->user()->token()->delete();
        return $this->res()->builder($data, 'Successfully Logout');
    }
}
