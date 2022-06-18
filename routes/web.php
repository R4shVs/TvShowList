<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware('auth')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::post('token', [TokenController::class, 'store'])->name('token.store');
    Route::delete('token/{token}', [TokenController::class, 'destroy'])->name('token.destroy');
});

require __DIR__.'/auth.php';
