<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudVersionThreeController;
use App\Http\Controllers\CrudVersionTwoController;
use App\Http\Controllers\CrudVersionOneController;

/**
 * CRUD V 3.0
 */
Route::resource('crud-v3', CrudVersionThreeController::class);


/**
 * CRUD V 2.0
 */
Route::get('/crud-v2', [CrudVersionTwoController::class, 'dashboard'])->name('home-v2');
Route::get('/crud-v2/single/{id}', [CrudVersionTwoController::class, 'singleView'])->name('single-v2');
Route::get('/crud-v2/create-form', [CrudVersionTwoController::class, 'createForm'])->name('create-form-v2');

Route::post('/crud-v2/store', [CrudVersionTwoController::class, 'storeMethod'])->name('store-method-v2');
Route::get('/crud-v2/edit/{id}', [CrudVersionTwoController::class, 'editMethod']);
Route::post('/crud-v2/update/{id}', [CrudVersionTwoController::class, 'updateMethod']);
Route::get('/crud-v2/delete/{id}', [CrudVersionTwoController::class, 'deleteMethod']);



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

