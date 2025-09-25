<?php

namespace App\Http\Controllers;

use App\Models\Conso_Personnels;
use App\Models\ConsoMission;
use App\Models\ConsoVehicule;
use Illuminate\Http\Request;

class MissionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("missions.home-mission", ['missions' => ConsoMission::with('vehicule')->get()]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $all_personnels = Conso_Personnels::where("sous_contrat", 1)
            ->orderBy("prenom")
            ->get();

        $mission = new ConsoMission();

        return view("missions.create-mission", [
            'vehicules' => ConsoVehicule::all(),
            "all_personnels" => $all_personnels,
            "mission" => $mission,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'objet' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required|after_or_equal:date_debut',
            'lieu' => 'required',
            'type_mission' => 'required',
            'etat' => 'required',
            'chauffeur' => 'required',
            'chef_mission' => 'required',
            'vehicule_id' => 'required',
            'description' => 'nullable',
        ]);
        ConsoMission::create($request->all());
        return redirect()->route('missions.index')->with('success', 'Mission créée');
    }

    /**
     * Display the specified resource.
     */
    public function show(ConsoMission $consoMission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $mission_id)
    {
        $mission = ConsoMission::find($mission_id);
        $all_personnels = Conso_Personnels::where("sous_contrat", 1)
            ->orderBy("prenom")
            ->get();

        return view("missions.create-mission", [
            'vehicules' => ConsoVehicule::all(),
            "all_personnels" => $all_personnels,
            "mission" => $mission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $mission_id)
    {
        //
        $consoMission = ConsoMission::findOrFail($mission_id);

           $request->validate([
            'objet' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required|after_or_equal:date_debut',
            'lieu' => 'required',
            'type_mission' => 'required',
            'etat' => 'required',
            'chauffeur' => 'required',
            'chef_mission' => 'required',
            'vehicule_id' => 'required',
            'description' => 'nullable',
        ]);
        $consoMission->update($request->all());
        return redirect()->route('missions.index')->with('success', 'Mission mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsoMission $consoMission)
    {
        //
    }
}
