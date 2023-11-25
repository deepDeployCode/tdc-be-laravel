<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface UserMasterDataInterface
{
    /**
     * set interface use for method master data user
     */
    public function list(Request $request);
    public function detail($id);
    public function store(Request $request);
    public function update($id, Request $request);
    public function delete($id);
}
