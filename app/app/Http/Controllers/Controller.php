<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function successJson($data = 'success'): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => $data
        ]);
    }

    public function failedJson($data = 'failed'): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => $data
        ]);
    }
}
