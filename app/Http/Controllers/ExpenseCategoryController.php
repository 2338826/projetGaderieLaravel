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
        return view('ExpenseCategory.index', compact('expenseCategories'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ExpenseCategory::create($request->all());
        return redirect()->route('expenseCategory.show')->with('success', 'Expense Category added successfully.');
    }

    public function edit($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        return view('ExpenseCategory.edit', compact('expenseCategory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
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
