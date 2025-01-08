<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class HelloController extends Controller
{
    public function hello(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message" => "Hello, World!",
        ]);
    }
}
