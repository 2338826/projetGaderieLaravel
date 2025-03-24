<?php

namespace App\Http\Controllers;

use App\Models\Nursery;
use Illuminate\Http\Request;

class NurseryController extends Controller
{
    public function index()
    {
        $nurseries = Nursery::orderBy('name')->get();

        return view('nursery');
    }
}
