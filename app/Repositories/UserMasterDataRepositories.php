<?php

namespace App\Repositories;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

trait UserMasterDataRepositories
{
    public function res()
    {
        return new Controller;
    }
    public function listRepositories($request)
    {
        return User::orderByDesc('id')
            ->when($request->name, function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->name}%");
            })->when($request->email, function ($query) use ($request) {
                $query->where('email', 'like', "%{$request->email}%");
            })->when($request->id, function ($query) use ($request) {
                $query->where('id', 'like', "%{$request->id}%");
            })
            ->paginate($this->res()->limit($request));
    }
    public function storeRepositories($request)
    {
        $createUserOnly = $request->only('name', 'email', 'password');
        $createUserOnly['password'] = Hash::make($request->password);
        return $this->res()->builder(User::create($createUserOnly), 'Successfully Create User');
    }
    public function updateRepositories($id, $request)
    {
        if (!$id && !$id > 0) { // id not field then error
            return $this->res()->builder('id null', 'id wajib di masukan', 422);
        } else {
            if ($user = User::whereId($id)->first()) { // check id user before update user
                $updateOnly = $request->only('name', 'email');
                if ($request->password) $updateOnly['password'] = Hash::make($request->password); // update password optional, in this statement code will operation event users field the password
                $user->update($updateOnly); //update data user
                return $this->res()->builder($updateOnly, 'Successfully Update User');
            } else {
                return $this->res()->builder('failed delete', 'id tidak di temukan', 422);
            }
        }
    }
    public function deleteRepositories($id)
    {
        if (!$id && !$id > 0) { // id not field then error
            return $this->res()->builder('id null', 'id wajib di masukan', 422);
        } else {
            if ($user = User::whereId($id)->first()) {
                $user->delete();
                return $this->res()->builder($user, 'Successfully Delete User'); //check id user before delete
            } else {
                return $this->res()->builder('failed delete', 'id tidak di temukan', 422);
            }
        }
    }
}
