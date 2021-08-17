<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RecordsController;
use App\Http\Controllers\LookupsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\SchemeGroupController;
use App\Http\Controllers\SchemeController;

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
  return redirect('/records');
})
  ->name('home');

Route::prefix('records')->group(function () {
  Route::get('/{id?}', [RecordsController::class, 'fetchByDateIndex'])
    ->name('records')
    ->where('id', '[0-9]+');
  Route::post('/', [RecordsController::class, 'store'])
    ->name('addRecord');
  Route::put('/{id}', [RecordsController::class, 'update'])
    ->name('editRecord')
    ->where('id', '[0-9]+');
  Route::delete('/{id}', [RecordsController::class, 'destroy'])
    ->name('deleteRecord')
    ->where('id', '[0-9]+');
});

Route::get('/loans/{id?}', [LoansController::class, 'index'])
  ->name('loans')
  ->where('id', '[0-9]+');

Route::get('/loan/{id?}', [LoansController::class, 'show'])
  ->name('showLoan')
  ->where('id', '[0-9]+');

Route::get('/lookups', [LookupsController::class, 'index'])
  ->name('lookups');

Route::prefix('categories')->group(function () {
  Route::delete('/{id}', [CategoryController::class, 'destroy'])
    ->name('deleteCategory')
    ->where('id', '[0-9]+');
});

Route::prefix('schemes')->group(function () {
  Route::get('/', [SchemeController::class, 'index'])
    ->name('schemes');
  Route::get('/{id}', [SchemeController::class, 'show'])
    ->name('showScheme')
    ->where('id', '[0-9]+');
  Route::post('/', [SchemeController::class, 'store'])
    ->name('addScheme');
  Route::put('{id}', [SchemeController::class, 'update'])
    ->name('editScheme')
    ->where('id', '[0-9]+');
  Route::delete('/{id}', [SchemeController::class, 'destroy'])
    ->name('deleteScheme')
    ->where('id', '[0-9]+');
});

Route::prefix('scheme_groups')->group(function () {
  Route::delete('/{id}', [SchemeGroupController::class, 'destroy'])
    ->name('deleteSchemeGroup')
    ->where('id', '[0-9]+');
});
