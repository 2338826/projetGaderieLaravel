<?php

namespace App\Http\Controllers;

use App\Models\Educator;
use App\Models\Expense;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()
    {
        $educators = Educator::all();
        $expenses = Expense::all();

        return view('report.show', compact('educators', 'expenses'));
    }
}
