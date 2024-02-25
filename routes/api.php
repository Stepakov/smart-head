<?php

use App\Http\Controllers\API\GenresController;
use App\Http\Controllers\API\MoviesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group( [
    'prefix' => 'movies',
    'controller' => MoviesController::class
], function () {
    Route::get( '/', 'index' );
    Route::get( '/{movie}', 'show' );
});

Route::group( [
    'prefix' => 'genres',
    'controller' => GenresController::class
], function () {
    Route::get( '/', 'index' );
    Route::get( '/{genre}', 'show' );
});

