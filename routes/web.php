<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\AddController;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

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

require __DIR__ . '/auth.php';

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'dologin']);
Route::get('/inscrire', [UserController::class, 'index'])->name('inscrire');
Route::post('/inscrire', [UserController::class, 'store'])->name('new');
Route::get('/remplir_bd', [AddController::class, 'remplir'])->name('remplir_bd');
Route::post('/add_dep', [AddController::class, 'add_dep'])->name('add_dep');
Route::post('/add_user', [AddController::class, 'add_user'])->name('add_user');
Route::post('/add_role', [AddController::class, 'add_role'])->name('add_role');
Route::post('/add_sal', [AddController::class, 'add_sal'])->name('add_sal');

Route::middleware('auth')->group(function () {

    Route::resource('todo', TodoController::class);

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('/')->controller(TodoController::class)->group(function () {
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

    Route::prefix('/')->controller(UserController::class)->group(function () {
        Route::get('/programmer', 'getPersonnel')->name('programmer');
        Route::get('/profil', 'profil')->name('profil');
        Route::get('/info', 'info')->name('info');
    });

    Route::prefix('/')->controller(CalendarController::class)->group(function () {
        Route::get('/calendar', 'calendar')->name('calendar');
        // Route::get('/plannings', 'index')->name('plannings');
    });

    Route::prefix('/')->controller(PlanningController::class)->group(function () {
        Route::get('/plannings', 'index')->name('plannings');
        Route::get('/affichage/{id}', 'affiche')->name('affiche_planning');
        Route::post('/ajout/{id}','store_tache')->name('ajout');
        Route::post('/store', 'store')->name('store_planning');
        Route::post('/store_evaluation', 'store_eval')->name('store_eval');
        Route::post('/pdf/{id}', 'getPDF')->name('pdf');
        Route::get('/planning_evaluation', 'plannings_eval')->name('eval');
        Route::get('/affiche_eval/{id}', 'affiche_eval')->name('affiche_eval');
        Route::post('/ajout_evaluation/{id}', 'store_tache_eval')->name('store_tache_eval');
        Route::delete('/destroy_planning/{id}', 'destroy_planning')->name('destroy_planning');
        Route::post('/duplique/{id}','duplique_tache')->name('duplique');
        Route::get('/get/{id}', 'get_tache')->name('get_tache');
    });

    Route::put('/edit/{id}',[PlanningController::class, 'edit_tache'])->name('edit');


    // Route::get('/generate-pdf', function () {
    //     $dompdf = new Dompdf();
    //     $html = View::make('affiche_planning')->renderSections()['content'];
    //     $dompdf->loadHtml($html);
    //     $dompdf->render();


    //     // Spécifiez le chemin complet du répertoire de stockage
    //     $directory = storage_path('app/public/');

    //     // Vérifiez si le répertoire existe, sinon, créez-le
    //     if (!file_exists($directory)) {
    //         mkdir($directory, 0777, true);
    //     }

    //     // Utilisez la classe Storage pour stocker le fichier PDF
    //     $filename = 'calendrier.pdf';
    //     $file = $directory . '/' . $filename;
    //     file_put_contents($file, $dompdf->output());

    //     // Utilisez Storage::url pour obtenir l'URL du fichier stocké
    //     $url = Storage::url('pdfs/' . $filename);
    //     return redirect('/affichage');
    // });
});
