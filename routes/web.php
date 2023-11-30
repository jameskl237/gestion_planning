<?php

use App\Http\Controllers\AuthController;
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
Route::get('inscrire',[UserController::class,'store'])->
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [TodoController::class,'index'])->name('welcome');
    Route::get('/{todo}/info',[TodoController::class,'info'])->name('info');
    // Route::post('/{todo}/info',[TodoController::class,'info']);
    Route::delete('/destroy/{id}',[TodoController::class,'destroy_web'])->name('destroy');
    Route::get('/new', [TodoController::class, 'create'])->name('create');
    Route::post('/new',[TodoController::class, 'store']);
    Route::get('/{todo}/edit', [TodoController::class, 'edit'])->name('edit');
    Route::patch('/{todo}/edit', [TodoController::class, 'update']);
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



