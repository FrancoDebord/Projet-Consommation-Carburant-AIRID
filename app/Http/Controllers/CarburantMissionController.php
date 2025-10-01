<?php

namespace App\Http\Controllers;

use App\Models\Conso_Personnels;
use App\Models\ConsoCarburantMission;
use App\Models\ConsoMission;
use App\Models\ConsoVehicule;
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

        $all_carburant_courses_semaine = ConsoCarburantMission::where("mission_id", 0)
            ->orderBy("date_remise", "desc")
            ->orderBy("remis_par")
            ->get();

        if ($mission) {
            $all_carburants_mission = $mission->carburants;
        }


        return view("missions.index-carburant-remis", compact("mission", "all_carburants_mission", "all_carburant_courses_semaine"));
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

        $all_vehicules = ConsoVehicule::orderBy("immatriculation")->get();

        $all_personnels = Conso_Personnels::where("sous_contrat", 1)
            ->orderBy("prenom")
            ->get();
        //
        return view('missions.create-remise-carburant-mission', [
            'missions' => ConsoMission::where("etat", "en_cours")->get(),
            'all_personnels' => $all_personnels,
            'carburant_mission' => $carburant_mission,
            'all_vehicules' => $all_vehicules,
            'all_personnels' => $all_personnels,
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
            'mission_id' => 'required',
            'vehicule_id' => 'required',
            'chauffeur_id' => 'required',
        ]);


        // 2. Gestion de l'upload
        if ($request->hasFile('image_kilometrage_depart')) {
            $file = $request->file('image_kilometrage_depart');

            // Générer un nom unique pour le fichier
            $filename = time() . '_' . $file->getClientOriginalName();

            // Stocker le fichier dans storage/app/public/carburants
            // $path = $file->storeAs('public/carburants_remis', $filename);
            $path = $file->store('carburants_remis', 'public');

            // Conserver le chemin relatif pour la BDD
            $validated['image_kilometrage_depart'] = $path;
        }


        $last_mission = ConsoMission::where("etat", "en_cours")
            ->where("vehicule_id", $request->vehicule_id)
            ->orderBy("date_debut", "desc")
            ->first();


        if ($last_mission && $request->mission_id != $last_mission->id) {

            return back()->with('error', 'Ce véhicule a une mission en cours non terminée. Veuillez sélectionner la bonne mission.')->withInput();
        }

        $carburant_mission_precedent = ConsoCarburantMission::where("mission_id", $request->mission_id)
            ->where("vehicule_id", $request->vehicule_id)
            ->orderBy("date_remise", "desc")
            ->first();


        $vehicule = ConsoVehicule::find($request->vehicule_id);

        $montant_restant = 0;


        if ($carburant_mission_precedent) { // S'il y avait un paiement précédent

            if ($request->kilometrage_depart < $carburant_mission_precedent->kilometrage_depart) {

                return back()->with('error', 'Ce kilométrage doit être supérieur au kilométrage départ de la demande précédente.')->withInput();
            }



            $distance_parcourue = $request->kilometrage_depart - $carburant_mission_precedent->kilometrage_depart;

            $mission_concernee = ConsoMission::find($request->mission_id);

            $quantite_carburant_consommee = 0;
            $montant_carburant_depense = 0;

            if ($mission_concernee) { //Si c'est une mission, on prend la consommation du véhicule affectée à la mission

                $quantite_carburant_consommee = ($distance_parcourue * $mission_concernee->conso_moyenne_vehicule) / 100;
                $montant_carburant_depense = ($quantite_carburant_consommee * $mission_concernee->vehicule->typeCarburant->prix_station);
            } else {
                //On prend directment pour le vehicule
                $quantite_carburant_consommee = ($distance_parcourue * $vehicule->conso_moyenne) / 100;
                $montant_carburant_depense = ($quantite_carburant_consommee * $vehicule->typeCarburant->prix_station);
            }

            //calcul du montant restant pour le carburant précédent
            $montant_restant = $carburant_mission_precedent->montant_restant - $montant_carburant_depense; // Le restant est égal au restant qui était là moins le montant dépensé maintenant

            //Si le montant est négatif, on garde 0
            $montant_restant = $montant_restant < 0 ? 0 : $montant_restant;

            //Mise à jour de l'ancien carburant remis
            $carburant_mission_precedent->distance_parcourue = $distance_parcourue;
            $carburant_mission_precedent->quantite_carburant_consommee = $quantite_carburant_consommee;
            $carburant_mission_precedent->montant_carburant_depense = $montant_carburant_depense;
            $carburant_mission_precedent->montant_restant = $montant_restant;
            $carburant_mission_precedent->save();
        }

        $validated["montant_restant"] = $montant_restant + $request->montant_carburant_remis;
        ConsoCarburantMission::create($validated);
        return redirect()->route('carburants.index', ["mission_id" => $request->mission_id])->with('success', 'Remise carburant enregistrée avec succès.');
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

        $all_vehicules = ConsoVehicule::orderBy("immatriculation")->get();

        $all_personnels = Conso_Personnels::where("sous_contrat", 1)
            ->orderBy("prenom")
            ->get();

        //
        return view('missions.create-remise-carburant-mission', [
            'missions' => ConsoMission::where("etat", "en_cours")->get(),
            'all_personnels' => $all_personnels,
            'carburant_mission' => $carburant_mission,
            'all_vehicules' => $all_vehicules,
            'all_personnels' => $all_personnels,
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
            'mission_id' => 'required',
            'vehicule_id' => 'required',
            'chauffeur_id' => 'required',
        ]);

        $montant_restant = 0;


        $carburant_mission = ConsoCarburantMission::findOrFail($id);

        // 2. Gestion de l'upload
        if ($request->hasFile('image_kilometrage_depart')) {
            $file = $request->file('image_kilometrage_depart');

            // Générer un nom unique pour le fichier
            $filename = time() . '_' . $file->getClientOriginalName();

            // Stocker le fichier dans storage/app/public/carburants
            // $path = $file->storeAs('public/carburants_remis', $filename);
            $path = $file->store('carburants_remis', 'public');

            // Conserver le chemin relatif pour la BDD
            $validated['image_kilometrage_depart'] = $path;
        }

        $last_mission = ConsoMission::where("etat", "en_cours")
            ->where("vehicule_id", $request->vehicule_id)
            ->orderBy("date_debut", "desc")
            ->first();

        if ($last_mission && $request->mission_id != $last_mission->id) {

            return back()->with('error', 'Ce véhicule a une mission en cours non terminée. Veuillez sélectionner la bonne mission.')->withInput();
        }



        $carburant_mission_precedent = ConsoCarburantMission::where("mission_id", $request->mission_id)
            ->where("date_remise", "<=", $carburant_mission->date_remise)
            ->where("id", "<>", $carburant_mission->id)
            ->where("vehicule_id", $request->vehicule_id)
            ->orderBy("date_remise", "desc")
            ->first();

        $vehicule = ConsoVehicule::find($request->vehicule_id);


        if ($carburant_mission_precedent) { // S'il y avait un paiement précédent

            if ($request->kilometrage_depart < $carburant_mission_precedent->kilometrage_depart) {

                return back()->with('error', 'Ce kilométrage doit être supérieur au kilométrage départ de la demande précédente.')->withInput();
            }


            $distance_parcourue = $request->kilometrage_depart - $carburant_mission_precedent->kilometrage_depart;

            $mission_concernee = ConsoMission::find($request->mission_id);

            $quantite_carburant_consommee = 0;
            $montant_carburant_depense = 0;

            if ($mission_concernee) { //Si c'est une mission, on prend la consommation du véhicule affectée à la mission

                $quantite_carburant_consommee = ($distance_parcourue * $mission_concernee->conso_moyenne_vehicule) / 100;
                $montant_carburant_depense = ($quantite_carburant_consommee * $mission_concernee->vehicule->typeCarburant->prix_station);
            } else {
                //On prend directment pour le vehicule
                $quantite_carburant_consommee = ($distance_parcourue * $vehicule->conso_moyenne) / 100;
                $montant_carburant_depense = ($quantite_carburant_consommee * $vehicule->typeCarburant->prix_station);
            }

            //calcul du montant restant pour le carburant précédent
            $montant_restant = $carburant_mission_precedent->montant_restant - $montant_carburant_depense; // Le restant est égal au restant qui était là moins le montant dépensé maintenant

            //Si le montant est négatif, on garde 0
            $montant_restant = $montant_restant < 0;
            0;
            $montant_restant;

            //Mise à jour de l'ancien carburant remis
            $carburant_mission_precedent->montant_restant = $montant_restant;
            $carburant_mission_precedent->distance_parcourue = $distance_parcourue;
            $carburant_mission_precedent->quantite_carburant_consommee = $quantite_carburant_consommee;
            $carburant_mission_precedent->montant_carburant_depense = $montant_carburant_depense;
            $carburant_mission_precedent->save();
        }

        $validated["montant_restant"] = $montant_restant + $request->montant_carburant_remis;

        $carburant_mission->update($validated);
        return redirect()->route('carburants.index', ["mission_id" => $request->mission_id])->with('success', 'Remise carburant mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
