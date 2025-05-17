<?php

namespace App\Http\Controllers;

use App\Models\Educator;
use App\Models\Expense;
use App\Models\Nursery;
use App\Models\Presence;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer toutes les garderies pour le menu déroulant
        $nurseries = Nursery::all();

        // Récupérer le nursery_id sélectionné ou utiliser le premier par défaut
        $selectedNurseryId = $request->query('nursery_id') ?? ($nurseries->first()->id ?? null);

        // Filtrer les présences par nursery_id si sélectionné
        $presences = $selectedNurseryId ? Presence::where('nursery_id', $selectedNurseryId)->get() : collect([]);

        // Filtrer les dépenses par nursery_id si sélectionné
        $expenses = $selectedNurseryId ? Expense::where('nursery_id', $selectedNurseryId)->get() : collect([]);

        // Compter le nombre de présences pour la garderie sélectionnée
        $totalPresences = $presences->count();

        // Revenu : Supposons 48 $ par présence
        $revenuParPresence = 48;
        $totalRevenu = $totalPresences * $revenuParPresence;

        // Dépenses
        $depensesAdmissibles = $expenses->sum(function ($expense) {
            return $expense->amount * ($expense->expenseCategory?->pourcentage ?? 0);
        });
        $salaireParHeure = 18;
        $heuresParPresence = 8;
        $totalSalaires = $totalPresences * $heuresParPresence * $salaireParHeure;
        $totalDepenses = $depensesAdmissibles + $totalSalaires;

        // Profit
        $profit = $totalRevenu - $totalDepenses;

        // Passer les données à la vue
        $selectedNursery = $selectedNurseryId ? Nursery::find($selectedNurseryId) : null;

        return view('report', compact('nurseries', 'presences', 'expenses', 'totalPresences', 'totalRevenu', 'depensesAdmissibles', 'totalSalaires', 'totalDepenses', 'profit', 'selectedNursery'));
    }
}