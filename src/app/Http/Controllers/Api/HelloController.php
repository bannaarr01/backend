<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class HelloController extends Controller
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      x={
     *          "logo": {
     *              "url": "https://via.placeholder.com/190x90.png?text=L5-Swagger"
     *          }
     *      },
     *      title="Web Engineer Api",
     *      description="Exam OpenApi description",
     *      @OA\Contact(
     *          email="joshboluwaji6@gmail.com"
     *      ),
     *     @OA\License(
     *         name="Apache 2.0",
     *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
     *     )
     * )
     */
    public function index()
    {

    }

    /**
     * @OA\Get(
     *     path="/api/hello",
     *     tags={"Hello"},
     *     summary="Returns Hello, world!",
     *     description="Returns Hello, world!",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     * )
     */
    public function hello(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message" => "Hello, World!",
        ]);
    }
}
