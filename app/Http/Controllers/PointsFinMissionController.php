<?php

namespace App\Http\Controllers;

use App\Models\ConsoMission;
use App\Models\ConsoPointsFinsMission;
use Illuminate\Http\Request;

class PointsFinMissionController extends Controller
{




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('missions.fin-mission', ['missions' => ConsoMission::all()]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['date_retour' => 'required', 'kilometrage_arrivee' => 'required']);
        ConsoPointsFinsMission::create($request->all());
        return back()->with('success', 'Fin de mission enregistrée');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
