<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FruitController;
use App\Http\Controllers\Api\HelloController;

Route::get('hello', [HelloController::class, 'hello']);

Route::controller(FruitController::class)->prefix('fruits')->group(function () {
    // **POST**: Add a new data item.
    Route::post('/', 'create');
    // **GET**: Retrieve a list of data items.
    Route::get('/', 'findAll');
    // **PUT**: Update a specific item by its ID.
    Route::put('/{id}', 'update')->where('id', '[0-9]+');
    // **DELETE**: Delete a specific item by its ID.
    Route::delete('/{id}', 'remove')->where('id', '[0-9]+');
});
