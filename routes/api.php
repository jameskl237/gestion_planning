<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\TodoController;


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

Route::get('todo',[TodoController::class,'index'])->name('Todos');
Route::post('todo',[TodoController::class,'store']);
Route::put('todo/{id}',[TodoController::class,'update']);
Route::delete('todo/{id}',[TodoController::class,'destroy']);
Route::get('todo/{id}',[TodoController::class,'show']);

Route::post('/color',[ColorController::class,'updateColor']);

Route::post('/login',[AuthController::class, 'dologin_api']);

Route::get('/calendar',[CalendarController::class,'index'])->name('calendar');
