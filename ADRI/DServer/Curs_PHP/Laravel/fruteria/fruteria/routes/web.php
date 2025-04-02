<?php
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrutaController;
use App\Http\Controllers\OrigenController;
use App\Http\Controllers\RegisterController;

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

 Route::get('/', function () {
     return view('inicio');
 });

Route::get('login', [LoginController::class, 'loginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('inicio');
    });

    Route::get('/origenes', [OrigenController::class, 'index'])->name('origenes.index');
    
    Route::resource('frutas', FrutaController::class);
});

// Esto va en el archivo .env
// DB_CONNECTION=mysql
//  DB_HOST=127.0.0.1
//  DB_PORT=3306
//  DB_DATABASE=fruteria
//  DB_USERNAME=root
//  DB_PASSWORD=
