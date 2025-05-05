<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::all();
        return view('state.show', compact('states'));
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $state = new State();
        $state->name = $request->input('name');
        $state->save();

        return redirect()->route('state.show')->with('success', 'State added successfully.');
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $state = State::findOrFail($id);
        $state->delete();

        return redirect()->route('state.show')->with('success', 'State deleted successfully.');
    }
}
