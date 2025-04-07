<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Models\Expense;
use App\Models\Nursery;

use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $expenseCategories = ExpenseCategory::all();
        return view('expenseCategory', compact('expenseCategories'));
    }

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

    public function edit($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        return view('expenseCategoryModify', compact('expenseCategory'));
    }

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

    public function destroy($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->delete();
        return redirect()->route('expenseCategory.show')->with('success', 'Expense Category deleted successfully.');
    }

    public function clear()
    {
        ExpenseCategory::truncate();
        return redirect()->route('expenseCategory.show')->with('success', 'All Expense Categories cleared successfully.');
    }
}
