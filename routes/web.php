<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Routing\Route as RoutingRoute;
use Symfony\Component\Routing\Annotation\Route as AnnotationRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login',[AuthController::class,'dologin']);
Route::get('/inscrire',[UserController::class,'index'])->name('inscrire');
Route::post('/inscrire',[UserController::class,'store'])->name('new');
Route::middleware('auth')->group(function () {


    Route::resource('todo',TodoController::class);

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('/')->controller(TodoController::class)->group(function(){
        Route::get('/', 'index')->name('welcome');
        Route::get('/{todo}/info', 'info')->name('info');
        Route::delete('/destroy/{id}', 'destroy_web')->name('destroy');
        Route::get('/new', 'create')->name('create');
        Route::put('/tache_update/{id}', 'edit')->name('tache_update');
        Route::get('/notification', 'notification')->name('notif');
        Route::post('/store_sub', 'store_sub')->name('store_sub');
        Route::get('/notif', 'controle_notification');
        Route::post('/is_view/{id}', 'is_view')->name('is_view');
    });

    Route::prefix('/')->controller(UserController::class)->group(function(){
        Route::get('/programmer', 'getPersonnel')->name('programmer');
        Route::get('/profil','profil')->name('profil');
    });
});


