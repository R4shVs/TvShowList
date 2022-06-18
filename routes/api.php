<?php

use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\ListController;
use App\Http\Controllers\Api\TvShowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/genre', [GenreController::class, 'index']);

    Route::get('/search', [TvShowController::class, 'index']);
    Route::get('/tv_show/{tv_show}', [TvShowController::class, 'show']);

    Route::post('/list/{tv_show}/add_tv_show', [ListController::class, 'store']);
    Route::get('/list', [ListController::class, 'index']);
    Route::patch('/list/{tv_show}/edit_tv_show', [ListController::class, 'update']);
    Route::delete('/list/{tv_show}/remove_tv_show', [ListController::class, 'destroy']);
});

