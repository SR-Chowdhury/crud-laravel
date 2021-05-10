<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudVersionOneController;

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

/**
 * CRUD V 1.0
 */
Route::get('/crud-v1', [CrudVersionOneController::class, 'dashboard'])->name('dashboard-v1');
Route::get('/crud-v1/create-form', [CrudVersionOneController::class, 'createForm'])->name('create-form-v1');
Route::post('/crud-v1/create', [CrudVersionOneController::class, 'createMethod'])->name('create-method-v1');

Route::get('/crud-v1/single/{id}', [CrudVersionOneController::class, 'singleView'])->name('single-v1');
Route::get('/crud-v1/edit/{id}', [CrudVersionOneController::class, 'editMethod']);
Route::post('/crud-v1/update/{id}', [CrudVersionOneController::class, 'updateMethod']);
Route::get('/crud-v1/delete/{id}', [CrudVersionOneController::class, 'deleteMethod']);

