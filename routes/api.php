<?php

use App\Http\Controllers\HotelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/hoteles',[HotelController::class, 'index']);
Route::post('hotel', [HotelController::class, 'guardar']);
Route::get('hotel/{id}/editar', [HotelController::class,'editar',]);
Route::put('hotel/{id}', [HotelController::class,'actualizar',]);
Route::delete('hotel/{id}', [HotelController::class,'eliminar',]);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
