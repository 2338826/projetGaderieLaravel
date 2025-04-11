<?php

namespace App\Http\Controllers;

use App\Models\Commerce;
use App\Models\Expense;
use App\Models\Nursery;
use App\Models\ExpenseCategory;

use Illuminate\Http\Request;

class CommerceController extends Controller
{
    public function index()
    {
        $commerces = Commerce::all();

        return view('commerce', compact('commerces'));
    }

    public function add(Request $request)
    {
        $commerce = new Commerce();
        $commerce->description = $request->description;
        $commerce->address = $request->address;
        $commerce->phone = $request->phone;
        $commerce->save();

        
        return redirect()->route('commerce.show')->with('success', 'Commerce added successfully.');


    }

    public function edit($id)
    {
        $commerce = Commerce::findOrFail($id);
        $nursery = Nursery::with('nursery', 'expense')->get();
        return view('commerceModify', compact('commerce'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $commerce = Commerce::findOrFail($id);
        $commerce->update($request->all());

        return redirect()->route('commerce.show')->with('success', 'Commerce updated successfully.');
    }

    public function destroy($id)
    {
        $commerce = Commerce::findOrFail($id);
        $commerce->delete();
        return redirect()->route('commerce.show')->with('success', 'Commerce deleted successfully.');
    }

    public function clear()
    {
        Commerce::truncate();
        return redirect()->route('commerce.show')->with('success', 'All Commerces cleared successfully.');
    }
}
