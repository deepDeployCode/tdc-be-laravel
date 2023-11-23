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
    }

    public function logout(Request $request)
    {
    }
}
