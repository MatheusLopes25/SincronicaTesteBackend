<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CategoriaController;
use App\Http\Controllers\Api\V1\ProdutoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('v1')->group(function () {
    Route::apiResource('produtos', ProdutoController::class);
    Route::apiResource('categorias',CategoriaController::class);

    $SemIdURL = function () {
        return response()->json(['erro' => 'É necessário informar o ID na URL.'], 400);
    };
    
    Route::put('/produtos', $SemIdURL);
    Route::put('/categorias', $SemIdURL);
    
    Route::delete('/produtos', $SemIdURL);
    Route::delete('/categorias', $SemIdURL);

});

// Route::apiResource('categorias', CategoriaController::class);
// Route::apiResource('produtos', ProdutoController::class);

