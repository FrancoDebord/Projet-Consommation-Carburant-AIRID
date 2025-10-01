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

        $data = $request->all();
        $consommation_vehicule = null;
        $prix_carburant = null;
        $vehicule = ConsoVehicule::find($request->vehicule_id);

        if ($vehicule) {

            $consommation_vehicule = $vehicule->conso_moyenne;
            $prix_carburant = $vehicule->typeCarburant->prix_station;
        }

        //controler s'il y a une mission en cours pour le véhicule sélectionné
        $mission_en_cours = ConsoMission::where("etat", "en_cours")
            ->where("vehicule_id", $request->vehicule_id)
            ->first();

        if ($mission_en_cours) {
            return redirect()->back()->withInput()->with('error', "Il y a déjà une mission en cours pour le véhicule sélectionné. Veuillez d'abord terminer cette mission avant d'en créer une nouvelle ou changer de véhicule.");
        }

        $data["conso_moyenne_vehicule"] = $consommation_vehicule;
        $data["prix_carburant"] = $prix_carburant;

        ConsoMission::create($data);
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

        $data = $request->all();
        $consommation_vehicule = null;
        $prix_carburant = null;
        $vehicule = ConsoVehicule::find($request->vehicule_id);

        if ($vehicule) {

            $consommation_vehicule = $vehicule->conso_moyenne;
            $prix_carburant = $vehicule->typeCarburant->prix_station;
        }

        $data["conso_moyenne_vehicule"] = $consommation_vehicule;
        $data["prix_carburant"] = $prix_carburant;


        //controler s'il y a une mission en cours pour le véhicule sélectionné
        $mission_en_cours = ConsoMission::where("etat", "en_cours")
            ->where("vehicule_id", $request->vehicule_id)
            ->where("id", "<>", $consoMission->id)
            ->first();

        if ($mission_en_cours) {
            return redirect()->back()->withInput()->with('error', "Il y a déjà une mission en cours pour le véhicule sélectionné. Veuillez d'abord terminer cette mission avant d'en créer une nouvelle ou changer de véhicule.");
        }

        $consoMission->update($data);
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
