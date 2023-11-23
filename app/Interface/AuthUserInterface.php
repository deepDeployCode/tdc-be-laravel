<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface AuthUserInterface
{
    /**
     * set interface use for method authentication
     */
    public function login(Request $request);
    public function register(Request $request);
    public function logout(Request $request);
}
