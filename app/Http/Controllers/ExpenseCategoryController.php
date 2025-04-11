<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Models\Expense;
use App\Models\Nursery;

use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
   /**
    * Function to display the list of expense categories.
    *
    * @return \Illuminate\View\View
     */
    public function index()
    {
        $expenseCategories = ExpenseCategory::all();
        return view('expenseCategory', compact('expenseCategories'));
    }

    /**
     * Function to display the form for adding a new expense category.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'pourcentage' => 'required|numeric|min:0|max:100',
        ]);

        $expenseCategory = new ExpenseCategory();
        $expenseCategory->description = $request->description;
        $expenseCategory->pourcentage = $request->pourcentage;
        $expenseCategory->save();

        return redirect()->route('expenseCategory.show')->with('success', 'Expense Category added successfully.');
    }

    /**
     * Function to display the form for editing an existing expense category.
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $expenseCategory = ExpenseCategory::with(['expenses.nursery', 'expenses.commerce'])->findOrFail($id);
        return view('expenseCategoryModify', compact('expenseCategory'));
    }

    /**
     * Function to update an existing expense category.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'pourcentage' => 'required|numeric|min:0|max:100',
        ]);

        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->update($request->all());

        return redirect()->route('expenseCategory.show')->with('success', 'Expense Category updated successfully.');
    }

    /**
     * Function to delete an existing expense category.
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->delete();
        return redirect()->route('expenseCategory.show')->with('success', 'Expense Category deleted successfully.');
    }

    /**
     * Function to clear all expense categories.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear()
    {
        ExpenseCategory::truncate();
        return redirect()->route('expenseCategory.show')->with('success', 'All Expense Categories cleared successfully.');
    }
}
