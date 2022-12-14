<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SugerenciasController;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/sugerencias', [SugerenciasController::class, 'sendMails'])->name('sugerencias');

Route::post('/sugerencias', [SugerenciasController::class, 'sendMailsProcessing'])->name('sugerencias.form');

Route::get('/mensaje', [MessageController::class,'index'])->name('mensaje')->middleware('auth');

Route::post('/mensaje', [MessageController::class,'store'])->name('mensaje.store')->middleware('auth');

Route::get('/notificaciones', [NotificacionController::class,'index'])->name('notificacion.all')->middleware('auth');

Route::get('/notificaciones/{id}', [NotificacionController::class,'show'])->name('notificacion.detalle')->middleware('auth');

Route::patch('/notificaciones/{id}', [NotificacionController::class,'update'])->name('notificacion.realizada')->middleware('auth');

Route::delete('/notificaciones/{id}', [NotificacionController::class,'destroy'])->name('notificacion.terminada')->middleware('auth');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
