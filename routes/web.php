<?php
use App\Http\Controllers\NurseryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CommerceController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\EducatorController;
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

Route::get('/Expenses/{id}/edit', [ExpenseController::class, 'edit'])->name('expense.edit');
Route::post('/Expenses/add', [ExpenseController::class, 'add'])->name('expense.add');
Route::put('/Expenses/{id}/update', [ExpenseController::class, 'update'])->name('expense.update');
Route::delete('/Expenses/{id}/delete', [ExpenseController::class, 'destroy'])->name('expense.destroy');
Route::delete('/Expenses/{id}/clear', [ExpenseController::class, 'clear'])->name('expense.clear');
Route::get('/Expenses', [ExpenseController::class, 'index'])->name('expense.show');

Route::get('/Commerce/{id}/edit', [CommerceController::class, 'edit'])->name('commerce.edit');
Route::post('/Commerce/add', [CommerceController::class, 'add'])->name('commerce.add');
Route::put('/Commerce/{id}/update', [CommerceController::class, 'update'])->name('commerce.update');
Route::delete('/Commerce/{id}/delete', [CommerceController::class, 'destroy'])->name('commerce.destroy');
Route::delete('/Commerce/{id}/clear', [CommerceController::class, 'clear'])->name('commerce.clear');
Route::get('/Commerce', [CommerceController::class, 'index'])->name('commerce.show');

Route::get('/ExpenseCategory/{id}/edit', [ExpenseCategoryController::class, 'edit'])->name('expenseCategory.edit');
Route::post('/ExpenseCategory/add', [ExpenseCategoryController::class, 'add'])->name('expenseCategory.add');
Route::put('/ExpenseCategory/{id}/update', [ExpenseCategoryController::class, 'update'])->name('expenseCategory.update');
Route::delete('/ExpenseCategory/{id}/delete', [ExpenseCategoryController::class, 'destroy'])->name('expenseCategory.destroy');
Route::delete('/ExpenseCategory/{id}/clear', [ExpenseCategoryController::class, 'clear'])->name('expenseCategory.clear');
Route::get('/ExpenseCategory', [ExpenseCategoryController::class, 'index'])->name('expenseCategory.show');

Route::get('/Educator/{id}/edit', [EducatorController::class, 'edit'])->name('educator.edit');
Route::post('/Educator/add', [EducatorController::class, 'add'])->name('educator.add');
Route::put('/Educator/{id}/update', [EducatorController::class, 'update'])->name('educator.update');
Route::delete('/Educator/{id}/delete', [EducatorController::class, 'destroy'])->name('educator.destroy');
Route::delete('/Educator/{id}/clear', [EducatorController::class, 'clear'])->name('educator.clear');
Route::get('/Educator', [EducatorController::class, 'index'])->name('educator.show');

Route::get('/Child/{id}/edit', [ChildController::class, 'edit'])->name('child.edit');
Route::post('/Child/add', [ChildController::class, 'add'])->name('child.add');
Route::put('/Child/{id}/update', [ChildController::class, 'update'])->name('child.update');
Route::delete('/Child/{id}/delete', [ChildController::class, 'destroy'])->name('child.destroy');
Route::delete('/Child/{id}/clear', [ChildController::class, 'clear'])->name('child.clear');
Route::get('/Child', [ChildController::class, 'index'])->name('child.show');

