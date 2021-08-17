<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\SchemeController;
use App\Http\Controllers\SchemeGroupController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('categories')->group(function () {
  Route::get('/', [CategoryController::class, 'index'])
    ->name('getAllCategories');
  Route::get('/{id}', [CategoryController::class, 'show'])
    ->name('getCategory')
    ->where('id', '[0-9]+');
  Route::post('/', [CategoryController::class, 'store'])
    ->name('addCategory');
  Route::put('/{id}', [CategoryController::class, 'update'])
    ->name('editCategory')
    ->where('id', '[0-9]+');
});

Route::prefix('loans')->group(function () {
  Route::get('/', [LoansController::class, 'getAll'])
    ->name('getAllLoans');
  Route::get('/{id}', [LoansController::class, 'get'])
    ->name('getLoan')
    ->where('id', '[0-9]+');
});

Route::prefix('records')->group(function () {
  Route::get('/{id}', [RecordsController::class, 'show'])
    ->name('getRecord')
    ->where('id', '[0-9]+');
  Route::get('/{id}/date', [RecordsController::class, 'fetchDateByIndex'])
    ->name('getDateByIndex')
    ->where('id', '[0-9]+');
});

Route::prefix('schemes')->group(function () {
  Route::get('/', [SchemeController::class, 'getAll'])
    ->name('getAllSchemes');
  Route::get('/{id}', [SchemeController::class, 'get'])
    ->name('getScheme')
    ->where('id', '[0-9]+');
  Route::get('/completion/{id}', [SchemeController::class, 'getCompletion'])
    ->name('getSchemeCompletion');
});

Route::prefix('scheme_groups')->group(function () {
  Route::get('/{id}', [SchemeGroupController::class, 'show'])
    ->name('getSchemeGroup')
    ->where('id', '[0-9]+');
  Route::post('/', [SchemeGroupController::class, 'store'])
    ->name('addSchemeGroup');
  Route::put('/{id}', [SchemeGroupController::class, 'update'])
    ->name('editSchemeGroup')
    ->where('id', '[0-9]+');
});