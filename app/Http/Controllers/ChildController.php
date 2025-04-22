<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Nursery;
use App\Models\State;



use Illuminate\Http\Request;

// Declare of class NurseryController
// extends the Controller class
// This class is used to manage the nursery

class ChildController extends Controller
{
    /*
    Function to show the nursery list
    */
    public function index()
    {

        $children = Child::with('state')->get();
        $states = State::all();
        return view('child', compact('children', 'states'));

        // $nurseries = Nursery::orderBy('name')->get();

        // return view('nursery');

    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'id_state' => 'required|exists:states,id',
            'phone' => 'required|string|max:15',
        ]);

        $Child = new Child();
        $Child->name = $request->name;
        $Child->firstName = $request->firstName;
        $Child->birth_date = $request->birth_date;
        $Child->address = $request->address;
        $Child->city = $request->city;
        $Child->id_state = $request->id_state;
        $Child->phone = $request->phone;
       
        $Child->save();

        return redirect()->route('child.show')->with('success', 'Child added successfully.');
    }
    public function edit($id)
    {
        $Child = Child::with('state')->findOrFail($id);
        $states = State::all();

        return view('childModify', compact('Child', 'states'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'id_state' => 'required|exists:states,id',
            'phone' => 'required|string|max:15',

        ]);

        $Child = Child::findOrFail($id);
        $Child->update($request->all());

        return redirect()->route('child.show')->with('success', 'Child updated successfully.');
    }
    public function destroy($id)
    {
        $Child = Child::findOrFail($id);
        $Child->delete();
        return redirect()->route('child.show')->with('success', 'Child deleted successfully.');
    }
    public function clear()
    {
        Child::truncate();
        return redirect()->route('child.show')->with('success', 'All Childs deleted successfully.');
    }
}