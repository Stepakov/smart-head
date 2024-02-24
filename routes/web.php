<?php

use App\Http\Controllers\GenresController;
use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get( 'movies/trashed', [ MoviesController::class, 'trashed' ] )
    ->name( 'movies.trashed' );
Route::put( 'movies/{movie}/restore', [ MoviesController::class, 'restore' ] )
    ->name( 'movies.restore' )->withTrashed();
Route::delete( 'movies/{movie}/forcedelete', [ MoviesController::class, 'forcedelete' ] )
    ->name( 'movies.forcedelete' )->withTrashed();
Route::resource( 'movies', MoviesController::class );

Route::get( 'genres/trashed', [ GenresController::class, 'trashed' ] )
    ->name( 'genres.trashed' );
Route::put( 'genres/{genre}/restore', [ GenresController::class, 'restore' ] )
    ->name( 'genres.restore' )->withTrashed();
Route::delete( 'genres/{genre}/forcedelete', [ GenresController::class, 'forcedelete' ] )
    ->name( 'genres.forcedelete' )->withTrashed();
Route::resource( 'genres', GenresController::class );
