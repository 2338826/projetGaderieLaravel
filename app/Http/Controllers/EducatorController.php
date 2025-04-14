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
}