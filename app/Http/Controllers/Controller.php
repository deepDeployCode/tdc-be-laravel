<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected static function errorValidation($errors)
    {
        $collectError = collect($errors); //collect error all
        $storeResError = collect([]); // store result error validation
        foreach ($collectError as $key => $value) {
            $res = array(
                'field' => $key,
                'message' => $value[0],
            );
            $storeResError->push($res);
        }
        return response()->json(['message' => 'Data tidak lengkap', 'errors' => $storeResError], 422);
    }

    protected static function builder($data, String $message = 'Successfully Data', int $statusCode = 200)
    {
        switch ($statusCode) {
            case 200:
                $res = array(
                    'message' => $message,
                    'data' => $data
                );
                break;
            default:
                $res = array('message' => $message); //another 200 then only show message response
                break;
        }
        return response()->json($res, $statusCode);
    }

    protected static function resDetail($data)
    {
        return response()->json($data);
    }

    protected static function limit($request)
    {
        $limit = 20;
        if ($limit >= $request->limit) {
            return $limit = $request->limit;
        }
    }
}
