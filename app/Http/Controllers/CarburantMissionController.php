<?php

namespace App\Http\Controllers;

use App\Models\Conso_Personnels;
use App\Models\ConsoCarburantMission;
use App\Models\ConsoMission;
use Illuminate\Http\Request;

class CarburantMissionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $mission = ConsoMission::find($request->mission_id);
        $all_carburants_mission = [];

        if ($mission) {
            $all_carburants_mission = $mission->carburants;
        }

        return view("missions.index-carburant-remis", compact("mission", "all_carburants_mission"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $all_personnels = Conso_Personnels::where("sous_contrat", 1)
            ->orderBy("prenom")
            ->get();

        $carburant_mission = new ConsoCarburantMission();
        //
        return view('missions.create-remise-carburant-mission', [
            'missions' => ConsoMission::all(),
            'all_personnels' => $all_personnels,
            'carburant_mission' => $carburant_mission,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated  = $request->validate([
            'kilometrage_depart' => 'required|numeric',
            'montant_carburant_remis' => 'required|numeric',
            'date_remise' => 'required|date',
            'image_kilometrage_depart' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'remis_par' => 'required|string',
            'observation' => 'required|string',
            'mission_id' => 'required|exists:conso_missions,id',
        ]);


        // 2. Gestion de l'upload
        if ($request->hasFile('image_kilometrage_depart')) {
            $file = $request->file('image_kilometrage_depart');

            // Générer un nom unique pour le fichier
            $filename = time() . '_' . $file->getClientOriginalName();

            // Stocker le fichier dans storage/app/public/carburants
            $path = $file->storeAs('public/carburants_remis', $filename);

            // Conserver le chemin relatif pour la BDD
            $validated['image_kilometrage_depart'] = $path;
        }

        ConsoCarburantMission::create($validated);
        return redirect()->route('carburants.index',["mission_id"=>$request->mission_id])->with('success', 'Remise carburant enregistrée avec succès.');
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
        $all_personnels = Conso_Personnels::where("sous_contrat", 1)
            ->orderBy("prenom")
            ->get();

        $carburant_mission =  ConsoCarburantMission::find($id);
        //
        return view('missions.create-remise-carburant-mission', [
            'missions' => ConsoMission::all(),
            'all_personnels' => $all_personnels,
            'carburant_mission' => $carburant_mission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated  = $request->validate([
            'kilometrage_depart' => 'required|numeric',
            'montant_carburant_remis' => 'required|numeric',
            'date_remise' => 'required|date',
            'image_kilometrage_depart' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'remis_par' => 'required|string',
            'observation' => 'required|string',
            'mission_id' => 'required|exists:conso_missions,id',
        ]);


        $carburant_mission = ConsoCarburantMission::findOrFail($id);
        // 2. Gestion de l'upload
        if ($request->hasFile('image_kilometrage_depart')) {
            $file = $request->file('image_kilometrage_depart');

            // Générer un nom unique pour le fichier
            $filename = time() . '_' . $file->getClientOriginalName();

            // Stocker le fichier dans storage/app/public/carburants
            $path = $file->storeAs('public/carburants_remis', $filename);

            // Conserver le chemin relatif pour la BDD
            $validated['image_kilometrage_depart'] = $path;
        }

        $carburant_mission->update($validated);
        return redirect()->route('carburants.index',["mission_id"=>$request->mission_id])->with('success', 'Remise carburant mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
