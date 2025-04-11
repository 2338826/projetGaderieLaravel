<?php

namespace App\Http\Controllers;

use App\Models\Commerce;
use App\Models\Expense;
use App\Models\Nursery;
use App\Models\ExpenseCategory;

use Illuminate\Http\Request;

class CommerceController extends Controller
{
    /**
     * Function to display the list of commerce.
     */
    public function index()
    {
        $commerces = Commerce::all();
        $nursery = Nursery::all();
        $expense = Expense::all();

        return view('commerce', compact('commerces', 'nursery', 'expense'));
    }

    /**
     * Function to display the form for adding a new commerce.
     */
    public function add(Request $request)
    {
        $commerce = new Commerce();
        $commerce->description = $request->description;
        $commerce->address = $request->address;
        $commerce->phone = $request->phone;
        $commerce->save();

        return redirect()->route('commerce.show')->with('success', 'Commerce added successfully.');
    }

    /**
     * Function to display the form for editing an existing commerce.
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Eager-load the expenses with their nursery and expenseCategory relationships
        $commerce = Commerce::findOrFail($id);
        $nursery = Nursery::whereHas('expenses', function ($query) use ($id) {
            $query->where('commerce_id', $id);
        })->with(['expenses.commerce', 'expenses.expenseCategory'])->get();

        return view('commerceModify', compact('commerce', 'nursery'));
    }

    /**
     * Function to update an existing commerce.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $commerce = Commerce::findOrFail($id);
        $commerce->update($request->all());

        return redirect()->route('commerce.show', ['commerce_id' => $commerce->id])
            ->with('success', 'Commerce updated successfully.');
    }

    /**
     * Function to delete an existing commerce.
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $commerce = Commerce::findOrFail($id);
        $commerce->delete();
        return redirect()->route('commerce.show')->with('success', 'Commerce deleted successfully.');
    }

    /**
     * Function to clear all commerce.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear()
    {
        Commerce::truncate();
        return redirect()->route('commerce.show')->with('success', 'All Commerces cleared successfully.');
    }
}