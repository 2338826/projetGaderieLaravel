<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\educator;
use App\Models\Nursery;
use App\Models\State;



use Illuminate\Http\Request;

// Declare of class NurseryController
// extends the Controller class
// This class is used to manage the nursery

class EducatorController extends Controller
{
    /*
    Function to show the nursery list
    */
    public function index()
    {

        $educators = Educator::with('state')->get();
        $states = State::all();
        return view('Educator', compact('educators', 'states'));

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

        $educator = new Educator();
        $educator->name = $request->name;
        $educator->firstName = $request->firstName;
        $educator->birth_date = $request->birth_date;
        $educator->address = $request->address;
        $educator->city = $request->city;
        $educator->id_state = $request->id_state;
        $educator->phone = $request->phone;
       
        $educator->save();

        return redirect()->route('educator.show')->with('success', 'Educator added successfully.');
    }
    public function edit($id)
    {
        $educator = Educator::with('state')->findOrFail($id);
        $states = State::all();

        return view('educatorModify', compact('educator', 'states'));
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

        $educator = Educator::findOrFail($id);
        $educator->update($request->all());

        return redirect()->route('educator.show')->with('success', 'Educator updated successfully.');
    }
    public function destroy($id)
    {
        $educator = Educator::findOrFail($id);
        $educator->delete();
        return redirect()->route('educator.show')->with('success', 'Educator deleted successfully.');
    }
    public function clear()
    {
        Educator::truncate();
        return redirect()->route('educator.show')->with('success', 'All educators deleted successfully.');
    }
}