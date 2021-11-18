<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\ItemCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/item-categories', [ItemCategoryController::class, 'index']);
Route::get('item-categories/{category}', [ItemCategoryController::class, 'show']);

Route::get('items/{item}', [ItemController::class, 'show']);
