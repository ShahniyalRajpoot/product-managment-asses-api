<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);


Route::middleware(['auth:sanctum'])->group( function () {
        Route::get('logout',[AuthController::class,'logout']);
        Route::get('/user-data',[AuthController::class,'getUserData']);
        Route::post('/save-new-product',[AuthController::class,'saveNewProduct']);
        Route::post('/delete-product',[AuthController::class,'deleteProduct']);
        Route::post('/edit-product',[AuthController::class,'editProduct']);
        Route::put('/update-product',[AuthController::class,'updateProduct']);
});
