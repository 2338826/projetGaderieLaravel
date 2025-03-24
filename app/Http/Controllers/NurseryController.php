<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NurseryController extends Controller
{
    public function index()
    {
        return view('nursery');
    }
}
