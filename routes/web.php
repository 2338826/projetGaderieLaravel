<?php
use App\Http\Controllers\NurseryController;
use App\Http\Controllers\ExpenseController;
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
Route::get('/Garderies', [NurseryController::class, 'index'])->name('nursery.show');
Route::get('/Expenses', [ExpenseController::class, 'index'])->name('expense.show');
Route::get('/Expenses/{id}/edit', [ExpenseController::class, 'edit'])->name('expense.edit');
Route::post('/Expenses/add', [ExpenseController::class, 'add'])->name('expense.add');
Route::put('/Expenses/{id}/update', [ExpenseController::class, 'update'])->name('expense.update');
Route::delete('/Expenses/{id}/delete', [ExpenseController::class, 'destroy'])->name('expense.destroy');
Route::delete('/Expenses/{id}/clear', [ExpenseController::class, 'clear'])->name('expense.clear');
// route::get('/contact', [PostController::class, 'contact']);  