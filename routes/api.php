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
Route::get('/tipos/{id}',[HotelController::class, 'tipos']);
Route::get('/acomodacionh/{id}/{tipo}',[HotelController::class, 'acomodacionh']);
Route::get('/get_cantidad_f/{id}',[HotelController::class, 'get_cantidad_f']);
Route::post('/acomodacionh/{id}',[HotelController::class, 'acomodacionh_guardar']);
Route::delete('acomodacionh/{id}', [HotelController::class,'acomodacionh_eliminar',]);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
