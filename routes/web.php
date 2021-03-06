<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PrController;
use App\Http\Controllers\CommentController;


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

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[CustomerController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::controller(CommentController::class)->group(function () {
    Route::prefix('comments')->group(function () {
    Route::post('/store', 'store')->name('comments.store');
    });
});

// Route::get('/', [IndexController::class, 'index']);

Route::get('/show/{customer}', [IndexController::class, 'show']);

Route::controller(CustomerController::class)->group(function() { 
    Route::prefix('customers')->group(function() {
        Route::get('/', 'index')->name('customers.index');
        Route::get('/create', 'create');
        Route::post('/create', 'store')->name('customers.create');
        Route::get('/show/{customer}', 'show')->name('customers.show');
        Route::get('/edit/{customer}', 'edit')->name('customers.edit');
        Route::post('/edit/{customer}', 'update');
        Route::get('/delete/{customer}', 'destroy')->name('customers.delete');
    });
    });

    Route::controller(SaleController::class)->group(function() {
        Route::prefix('sales')->group(function() {
            Route::get('/', 'index')->name('sales.index');
            Route::get('/create', 'create');
            Route::post('/create', 'store')->name('sales.create');
            Route::get('/show/{sale}', 'show')->name('sales.show');
            Route::get('/edit/{sale}', 'edit')->name('sales.edit');
            Route::post('edit/{sale}', 'update');
            Route::get('delete/{sale}', 'destroy')->name('sales.delete');
        });
        });
    
    Route::controller(PrController::class)->group(function() {
        
        Route::prefix('prs')->group(function() {
            Route::get('/', 'index')->name('prs.index');
            Route::get('/create', 'create');
            Route::post('/create', 'store')->name('prs.create');
            Route::get('/show/{pr}', 'show')->name('prs.show');
            Route::get('/edit/{pr}', 'edit')->name('prs.edit');
            Route::post('edit/{pr}', 'update');
            Route::get('delete/{pr}', 'destroy')->name('prs.delete');
        });
    });
