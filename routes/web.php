<?php

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
Route::get('/', [NurseryController::class, 'index']);
Route::get('/garderie/{id}/edit', [NurseryController::class, 'edit'])->name('nursery.edit');
Route::post('/garderies/add', [NurseryController::class, 'add'])->name('nursery.add');
Route::put('/garderie/{id}/update', [NurseryController::class, 'update'])->name('nursery.update');
Route::delete('/garderie/{id}/delete', [NurseryController::class, 'destroy'])->name('nursery.destroy');
Route::delete('/garderie/clear', [NurseryController::class, 'clear'])->name('nursery.clear');
Route::get('/Garderies', [NurseryController::class, 'show'])->name('nursery.show'); 
route::get('/contact', [PostController::class, 'contact']);  