<?php

namespace App\Http\Controllers;

use App\Models\Nursery;
use App\Models\State;


use Illuminate\Http\Request;

class NurseryController extends Controller
{
    public function index()
    {

        $nurseries = Nursery::with('state')->get();
        $states = State::all();
        return view('nursery', compact('nurseries', 'states'));

        // $nurseries = Nursery::orderBy('name')->get();

        // return view('nursery');

    }

    public function add(Request $request)
    {
        $nursery = new Nursery();
        $nursery->name = $request->name;
        $nursery->address = $request->address;
        $nursery->city = $request->city;
        $nursery->phone = $request->phone;
        $nursery->id_state = $request->id_state;
        $nursery->save();

        return redirect()->route('nursery.show');
    }

    public function edit($id)
    {
        $nursery = Nursery::findOrFail($id);
        $states = State::all();

        return view('nurseryModify', compact('states', 'nursery'));
    }

    public function update(Request $request, $id)
    {
        $nursery = Nursery::findOrFail($id);
        $nursery->name = $request->name;
        $nursery->address = $request->address;
        $nursery->city = $request->city;
        $nursery->id_state = $request->id_state;
        $nursery->phone = $request->phone;
        $nursery->save();

        return redirect()->route('nursery.show');
    }

    public function destroy($id)
    {
        $nursery = Nursery::findOrFail($id);
        $nursery->delete();

        return redirect()->route('nursery.show');
    }

    public function clear()
    {
        Nursery::truncate();

        return redirect()->route('nursery.show');
    }

}
