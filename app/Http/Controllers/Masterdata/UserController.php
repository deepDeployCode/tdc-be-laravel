<?php

namespace App\Http\Controllers\Masterdata;

use App\Http\Controllers\Controller;
use App\Interface\UserMasterDataInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UserMasterDataRepositories;

class UserController extends Controller implements UserMasterDataInterface
{
    use UserMasterDataRepositories;
    public function list(Request $request)
    {
        return $this->listRepositories($request);
    }
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|string|min:5',
        ], [
            'required' => ':attribute wajib di isi',
            'email' => 'format email salah',
            'confirmed' => 'password tidak sama',
            'unique' => 'email ini sudah terdaftar harap gunakan email lain',
            'min' => 'password minimal 5 digit',
        ]);
        if ($validation->fails()) {
            $result = $this->errorValidation($validation->errors());
        } else {
            $result = $this->storeRepositories($request);
        }
        return $result;
    }
    public function update($id, Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'string',
            'email' => 'email',
            'password' => 'confirmed|string|min:5',
        ], [
            'email' => 'format email salah',
            'confirmed' => 'password tidak sama',
            'unique' => 'email ini sudah terdaftar harap gunakan email lain',
            'min' => 'password minimal 5 digit',
        ]);
        if ($validation->fails()) {
            $result = $this->errorValidation($validation->errors());
        } else {
            $result = $this->updateRepositories($id, $request);
        }
        return $result;
    }
    public function delete($id)
    {
        return $this->deleteRepositories($id);
    }
}
