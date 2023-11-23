<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Interface\AuthUserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\AuthUserRepositories;

class AuthUserController extends Controller implements AuthUserInterface
{
    use AuthUserRepositories;

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'required' => ':attribute wajib di isi',
            'email' => 'format email salah',
        ]);
        if ($validate->fails()) {
            $result = $this->errorValidation($validate->errors());
        } else {
            $result = $this->loginRepositories($request);
        }
        return $result;
    }

    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|string',
        ], [
            'required' => ':attribute wajib di isi',
            'email' => 'format email salah',
            'confirmed' => 'password tidak sama',
            'unique' => 'email ini sudah terdaftar harap gunakan email lain'
        ]);
        if ($validate->fails()) {
            $result = $this->errorValidation($validate->errors());
        } else {
            $result = $this->builder($this->registerRepositories($request), 'Successfully Register');
        }
        return $result;
    }

    public function logout(Request $request)
    {
    }
}
