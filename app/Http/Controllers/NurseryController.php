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
    }
}
