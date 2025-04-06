<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Models\Nursery;
use App\Models\Expense;
use App\Models\Commerce;


use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /*
  Function to show the expense list
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
    /*
   Function to Add the expense
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

    /*
    Function to show the expense form
    */
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        $categories = ExpenseCategory::all();
        $commerces = Commerce::all();
        $nurseries = Nursery::all();

        return view('expenseModify', compact('expense', 'categories', 'commerces', 'nurseries'));
    }
    /*
       Function to update the expense
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

        return redirect()->route('expense.show', ['nursery_id' => $expense->nursery_id])->with('success', 'Expense updated successfully.');
    }
    /*
   Function to delete the expense
   */
    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('expense.show', ['nursery_id' => $expense->nursery_id])->with('success', 'Expense deleted successfully.');
    }
    /*
   Function to clear the expense list
   */
    public function clear()
    {
        Expense::truncate();

        return redirect()->route('expense.show')->with('success', 'All expenses cleared successfully.');
    }



}