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
     * Return Fruit List
     *
     * @return JsonResponse
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
     * Create new Fruit
     *
     * @param FruitRequest $request
     * @return JsonResponse
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
     * Update the specified fruit.
     *
     * @param Request $request
     * @param int $fruitId
     * @return JsonResponse
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
     * Remove the specified fruit.
     *
     * @param int $fruitId
     * @return JsonResponse
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
