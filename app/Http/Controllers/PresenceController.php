<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresenceController extends Controller
{
    /**
     * Display a listing of the presences.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index()
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

        Presence::create($request->all());

        return redirect()->route('presence.show')->with('success', 'Presence added successfully.');
    }

    /**
     * Show the form for editing the specified presence.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $presence = Presence::findOrFail($id);
        $nurseries = Nursery::all();
        $educators = Educator::all();
        $children = Child::all();

        return view('presenceModify', compact('presence', 'nurseries', 'educators', 'children'));
    }

    /**
     * Update the specified presence in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'nursery_id' => 'required|exists:nurseries,id',
            'child_id' => 'required|exists:children,id',
            'educator_id' => 'required|exists:educators,id',
        ]);

        $presence = Presence::findOrFail($id);
        $presence->update($request->all());

        return redirect()->route('presence.show')->with('success', 'Presence updated successfully.');
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
