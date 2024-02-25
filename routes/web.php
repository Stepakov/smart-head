<?php

use App\Http\Controllers\Admin\Genre\GenresController;
use App\Http\Controllers\Admin\Movie\MoviesController;
use App\Http\Controllers\Public\GenresController as GenresControllerAlias;
use App\Http\Controllers\Public\MoviesController as MoviesControllerAlias;
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

Route::prefix( 'admin' )->group( function(){
    Route::group([
        'prefix' => 'movies',
        'controller' => MoviesController::class
    ], function () {
        Route::post( '/{movie}/status/{status}', 'status' )
            ->name( 'movies.status' );
        Route::get( '/trashed', 'trashed' )
            ->name( 'movies.trashed' );
        Route::put( '/{movie}/restore', 'restore' )
            ->name( 'movies.restore' )->withTrashed();
        Route::delete( '/{movie}/forcedelete', 'forcedelete' )
            ->name( 'movies.forcedelete' )->withTrashed();
    });

    Route::resource( 'movies', MoviesController::class );

    Route::prefix( 'admin' )->group( function() {
        Route::group([
            'prefix' => 'genres',
            'controller' => GenresController::class
        ], function () {
            Route::get('/trashed', 'trashed')
                ->name('genres.trashed');
            Route::put('/{genre}/restore', 'restore')
                ->name('genres.restore')->withTrashed();
            Route::delete('/{genre}/forcedelete', 'forcedelete')
                ->name('genres.forcedelete')->withTrashed();
        });
    });

    Route::resource( 'genres', GenresController::class );
});

Route::name( 'public.' )->group( function(){
    Route::group( [
        'prefix' => 'movies',
        'controller' => MoviesControllerAlias::class
    ], function(){
        Route::get( '/', 'index' )->name( 'movies.index');
        Route::get( '/{movie}/show', 'show' )->name( 'movies.show' );
    });
    Route::group( [
        'prefix' => 'genres',
        'controller' => GenresControllerAlias::class
    ], function() {
        Route::get( '/', 'index' )->name( 'genres.index');
        Route::get( '/{genre}/show', 'show' )->name( 'genres.show' );
    });
});

