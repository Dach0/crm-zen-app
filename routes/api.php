<?php

use App\Http\Controllers\Api\ResourceItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('resource-items', ResourceItemController::class)->except('show');
Route::get('resource-types', [\App\Http\Controllers\Api\ResourceItemTypeController::class, 'index']);
