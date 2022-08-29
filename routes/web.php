<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CategoryController;

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


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [MediaController::class, 'index']);
    Route::get('/dashboard', [MediaController::class, 'index']);

    Route::get('/media', [MediaController::class, 'index']);
    Route::post('/save-media', [MediaController::class, 'store']);
    Route::post('/update-media', [MediaController::class, 'update']);
    Route::get('/show-media/{id}', [MediaController::class, 'show']);
    Route::get('/delete-media/{id}', [MediaController::class, 'destroy']);

    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/save-category', [CategoryController::class, 'store']);
    Route::post('/update-category', [CategoryController::class, 'update']);
    Route::get('/show-category/{id}', [CategoryController::class, 'show']);
    Route::get('/delete-category/{id}', [CategoryController::class, 'destroy']);
    
    
});
/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

require __DIR__.'/auth.php';
