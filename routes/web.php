<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\WelcomeController;



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

// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
// Route::get('/', function () { return view('welcome');});
// });
//ruta de prueba
// Route::get('/leo', function () { 
//     // // $disk = Storage::disk('gcs');
//     // //  $url = $disk->url('folder/my_file.txt');
//     // Storage::disk('gcs')->url('folder/my_file.txt');
//     Storage::disk('gcs')->put('file.txt', 'Contents');
//     return 'leo el mejor' ;
// });


Route::get('/', [PostController::class,'index'])->name('posts.index');
//Route::get('/leo', WelcomeController::class)->name('posts.index');

Route::get('posts/{pos}',[PostController::class,'show'])->name('posts.show');
Route::get('category/{category}',[PostController::class,'category'])->name('posts.category');
Route::get('tag/{tag}',[PostController::class,'tag'])->name('posts.tag');
Route::get('destacados',[PostController::class,'destacado'])->middleware(['auth', 'verified'])->name('posts.destacado');

//route de pruebas
//Route::get('prueba', function () { return view('posts.prueba');})->name('posts.prueba');
Route::get('/leo', WelcomeController::class);
Route::get('carrusel', function () { return view('posts.carrusel');})->name('posts.carrusel');
Route::post('/leo', [PostController::class,'meencanta'] )->name('posts.meencanta');
//hasta aqui las rutas de pruebas

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',
])->group(function () {
    Route::get('/dashboard', function () {  return view('dashboard');  })->name('dashboard');
});

//rutas para loguear con redes sociales primero facebook
Route::get('/auth/redirect',[AuthController::class,'redirect'])->name('auth.redirect');
 
Route::get('/auth/callback',[AuthController::class,'callback'])->name('auth.callback');

//rutas para loguear con redes sociales primero google
Route::get('/auth/redirectg',[AuthController::class,'redirectg'])->name('auth.redirectg');
 
Route::get('/auth/callbackg',[AuthController::class,'callbackg'])->name('auth.callbackg');


//verificacion de correo antes de crear el usuario
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

//esta es la ruta que devuelve despues de verificar el correo
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');