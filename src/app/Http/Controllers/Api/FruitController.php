<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FruitRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Fruit;

class FruitController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/fruits",
     *     tags={"Fruits"},
     *     summary="Returns lists of fruits",
     *     description="Returns the list of fruits available in DB",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Fruit")
     *         )
     *     ),
     * )
    */
    public function findAll(): JsonResponse
    {
        $fruits = Fruit::all();
        return response()->json([
            'statusCode' => 200,
            'message' => 'OK',
            'data' => $fruits
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/fruits",
     *     tags={"Fruits"},
     *     summary="Persist a new fruit into the DB",
     *     @OA\Response(
     *         response=200,
     *         description="successful created",
     *         @OA\JsonContent(ref="#/components/schemas/Fruit"),
     *     ),
     *     @OA\RequestBody(
     *          description="Persist a fruit into the DB",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="Apple"
     *              )
     *          )
     *      )
     *  )
     */
    public function create(FruitRequest $request): JsonResponse
    {
        $request->validated();

        $fruitData = $request->safe()->only(['name']);

        $fruit = Fruit::create($fruitData);

        return response()->json([
            'statusCode' => 201,
            'message' => 'OK',
            'data' => $fruit,
        ], 201);
    }

    /**
     * Find and validate fruit existence
     *
     * @param int $fruitId
     * @return Fruit|JsonResponse
     */
    protected function findFruit(int $fruitId): Fruit|JsonResponse
    {
        $fruit = Fruit::find($fruitId);

        if (!$fruit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid fruit id',
            ], 400);
        }

        return $fruit;
    }

    /**
     * @OA\Put(
     *     path="/api/fruits/{id}",
     *     tags={"Fruits"},
     *     summary="Update a fruit by ID",
     *     description="For valid response try integer IDs with positive integer value. Negative or non-integer values will generate API errors",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the fruit that needs to be updated",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             minimum=1
     *         )
     *     ),
     *          @OA\RequestBody(
     *           description="Persist a fruit into the DB",
     *           required=true,
     *           @OA\JsonContent(
     *               required={"name"},
     *               @OA\Property(
     *                   property="name",
     *                   type="string",
     *                   example="Apple"
     *               )
     *           )
     *       ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid fruit id"
     *     ),
     *          @OA\Response(
     *          response=200,
     *          description="OK"
     *      ),
     * ),
     */
    public function update(Request $request, int $fruitId): JsonResponse
    {
        $fruit = $this->findFruit($fruitId);

        // return it immediately
        if ($fruit instanceof JsonResponse) {
            return $fruit;
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255'
        ]);

        $fruit->update($validated);

        return response()->json([
            'statusCode' => 200,
            'message' => 'OK',
            'data' => $fruit,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/fruits/{id}",
     *     tags={"Fruits"},
     *     summary="Delete fruit by ID",
     *     description="For valid response try integer IDs with positive integer value. Negative or non-integer values will generate API errors",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the fruit that needs to be deleted",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid fruit id"
     *     ),
     * ),
     */
    public function remove(int $fruitId): JsonResponse
    {
        $fruit = $this->findFruit($fruitId);

        if ($fruit instanceof JsonResponse) {
            return $fruit;
        }

        $fruit->delete();

        return response()->json([
            'statusCode' => 200,
            'message' => 'OK'
        ]);
    }
}
