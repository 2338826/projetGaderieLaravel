<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Models\Nursery;
use App\Models\Expense;
use App\Models\Commerce;


use Illuminate\Http\Request;

/*
 * Class ExpenseController
 * @package App\Http\Controllers
 *
 * This controller handles the management of expenses, including displaying,
 * adding, editing, updating, and deleting expenses.
 */
class ExpenseController extends Controller
{
    /**
     * Display a listing of the expenses.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $nurseryId = $request->query('nursery_id');
        $nurseries = Nursery::all();

        if ($nurseries->isEmpty()) {
            return view('expense', [
                'expenses' => collect(),
                'categories' => ExpenseCategory::all(),
                'commerces' => Commerce::all(),
                'nurseries' => $nurseries,
                'selectedNursery' => null,
            ]);
        }

        $selectedNursery = $nurseryId ? Nursery::find($nurseryId) : $nurseries->first();

        $expenses = $selectedNursery
            ? Expense::where('nursery_id', $selectedNursery->id)
                ->with('ExpenseCategory', 'commerce')
                ->get()
            : collect();

        $categories = ExpenseCategory::all();
        $commerces = Commerce::all();

        return view('expense', compact('expenses', 'categories', 'commerces', 'nurseries', 'selectedNursery'));
    }

    /**
     * Show the form for creating a new expense.
     *
     * @return \Illuminate\View\View
     */
    public function add(Request $request)
    {
        $request->validate([
                    'amount' => 'required|numeric',
                    'category_expense_id' => 'required|exists:expense_categories,id',
                    'commerce_id' => 'required|exists:commerces,id',
                    'nursery_id' => 'required|exists:nurseries,id',
                ]);
        
                Expense::create([
                    'dateTime' => now(),
                    'amount' => $request->amount,
                    'category_expense_id' => $request->category_expense_id,
                    'commerce_id' => $request->commerce_id,
                    'nursery_id' => $request->nursery_id,
                ]);
        
                return redirect()->route('expense.show', ['nursery_id' => $request->nursery_id]);

    }

    /**
     * Show the form for editing the specified expense.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        $categories = ExpenseCategory::all();
        $commerces = Commerce::all();
        $nurseries = Nursery::all();

        return view('expenseModify', compact('expense', 'categories', 'commerces', 'nurseries'));
    }

    /**
     * Update the specified expense in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'dateTime' => 'required|date',
            'amount' => 'required|numeric',
            'nursery_id' => 'required|exists:nurseries,id',
            'commerce_id' => 'required|exists:commerces,id',
            'category_expense_id' => 'required|exists:expense_categories,id',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->update($request->all());

        return redirect()->route('expense.show')->with('success', 'Expense updated successfully.');
    }

    /**
     * Remove the specified expense from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('expense.show')->with('success', 'Expense deleted successfully.');
    }

    /**
     * Clear all expenses from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear()
    {
        Expense::truncate();

        return redirect()->route('expense.show')->with('success', 'All expenses cleared successfully.');
    }



}