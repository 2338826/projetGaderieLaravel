<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\Nursery;
use App\Models\Educator;
use App\Models\Child;

class PresenceController extends Controller
{
    /**
     * Display a listing of the presences.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $nurseryId = $request->query('nursery_id');
        $nurseries = Nursery::all();

        if ($nurseries->isEmpty()) {
            return view('presence', [
                'presences' => collect(),
                'nurseries' => Nursery::all(),
                'educators' => Educator::all(),
                'children' => Child::all(),
                'selectedNursery' => null,
            ]);
        }
        $selectedNursery = $nurseryId ? Nursery::find($nurseryId) : $nurseries->first();
        $presences = $selectedNursery
            ? Presence::where('nursery_id', $selectedNursery->id)
                ->with('educator', 'child')
                ->get()
            : collect();
        $educators = Educator::all();
        $children = Child::all();
        return view('presence', compact('presences', 'nurseries', 'educators', 'children', 'selectedNursery'));

    }

    /**
     * Show the form for creating a new presence.
     *
     * @return \Illuminate\View\View
     */
    public function add(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'nursery_id' => 'required|exists:nurseries,id',
            'child_id' => 'required|exists:children,id',
            'educator_id' => 'required|exists:educators,id',
        ]);

        Presence::create([
            'date' => now(),
            'nursery_id' => $request->nursery_id,
            'child_id' => $request->child_id,
            'educator_id' => $request->educator_id,
        ]);

        return redirect()->route('presence.show',['nursery_id' => $request->nursery_id]);
    }



    /**
     * Remove the specified presence from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $presence = Presence::findOrFail($id);
        $presence->delete();

        return redirect()->route('presence.show')->with('success', 'Presence deleted successfully.');
    }

    /**
     * Clear all presences from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear()
    {
        Presence::truncate();

        return redirect()->route('presence.show')->with('success', 'All presences cleared successfully.');
    }
}
