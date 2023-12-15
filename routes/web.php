<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use Illuminate\Auth\Events\Logout;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(LoginController::class)->group(function() {
    Route::get('login', 'index')->name('login.index');
    Route::post('login', 'trylogin')->name('login.trylogin');
    Route::get('logout', 'destroy')->name('login.destroy');
});

Route::middleware(['user'])->group(function () {
    Route::get('/user', function () {
        return 'Esta é a rota para usuários normais';
    });
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Esta é a rota para administradores';
    });
});
