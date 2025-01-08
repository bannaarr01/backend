<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FruitController;
use App\Http\Controllers\Api\HelloController;

Route::get('hello', [HelloController::class, 'hello']);
