<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function errorValidation($errors)
    {
        $collectError = collect($errors);
        $storeResError = collect([]);
        foreach ($collectError as $key => $value) {
            $res = array(
                'field' => $key,
                'message' => $value[0],
            );
            $storeResError->push($res);
        }
        return response()->json(['message' => 'Data tidak lengkap', 'errors' => $storeResError], 422);
    }
}
