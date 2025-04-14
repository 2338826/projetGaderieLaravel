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
}