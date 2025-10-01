<?php

namespace App\Http\Controllers;

use App\Models\ConsoCarburantMission;
use App\Models\ConsoMission;
use App\Models\ConsoTypeCarburant;
use App\Models\ConsoVehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    //

    function indexPage()
    {

        return view("accueil");
    }

    function indexVehicule(Request $request)
    {

        return view("vehicules.index-vehicule");
    }

    function createVehicule(Request $request)
    {

        return view("vehicules.create-vehicule");
    }
    function createMission(Request $request)
    {

        return view("missions.create-mission");
    }

    function remiseCarburantMissionPage(Request $request)
    {

        return view("missions.create-remise-carburant-mission");
    }

    function enregistrerFinMissionPage(Request $request)
    {

        return view("missions.fin-mission");
    }

    function homeMission(Request $request)
    {

        return view("missions.home-mission");
    }

    function indexDashboard(Request $request)
    {

        return view("dashboard.index-dashboard");
    }

    function DashboardCarburant(Request $request)
    {

        $all_vehicules = ConsoVehicule::all();
        $all_missions = ConsoMission::all();
        $types_carburants = ConsoTypeCarburant::all();

        $vehiculeSelectionne = null;
        $missionSelectionnee = null;
        $remises_carburants =ConsoCarburantMission::query();
        $labels = [];
        $data = [];

        $vehicule_id = $request->input('vehicule_id');
        if ($vehicule_id) {
            $vehiculeSelectionne = ConsoVehicule::find($vehicule_id);

            $remises_carburants = $remises_carburants->where('vehicule_id', $vehicule_id);
        }

        $mission_id = $request->input('mission_id');
        if ($mission_id) {
            $missionSelectionnee = ConsoMission::find($mission_id);
            $remises_carburants = $remises_carburants->where('mission_id', $mission_id);
        }


        $mois = $request->input('mois');
        if ($mois) {
            $remises_carburants = $remises_carburants->whereMonth('date_remise', $mois);
        }

        $annee = $request->input('annee');
        if ($annee) {
            $remises_carburants = $remises_carburants->whereYear('date_remise', $annee);
        }


        $date_debut = $request->input('date_debut');
        if ($date_debut) {
            $remises_carburants = $remises_carburants->whereDate('date_remise', '>=', $date_debut);
        }

        $date_fin = $request->input('date_fin');
        if ($date_fin) {
            $remises_carburants = $remises_carburants->whereDate('date_remise', '<=', $date_fin);
        }

        $remises_carburants_graphiques = clone $remises_carburants;

        $remises_carburants_graphiques = $remises_carburants_graphiques->orderBy('date_remise',"asc")
        ->groupBy('date_remise')
        ->select(DB::Raw('date_remise, SUM(montant_carburant_remis) as total_montant'))
        ->get();

        foreach ($remises_carburants_graphiques??[] as $key => $remise) {
            $labels[] = date("d-m-Y", strtotime($remise->date_remise));
            $data[] = $remise->total_montant;

        }

        $data = array_map('floatval', $data);


        $remises_carburants = $remises_carburants->orderBy('date_remise',"desc")->get();


        return view("dashboard.dashboard-carburant", compact('all_vehicules', 'all_missions',
         'types_carburants', 'vehiculeSelectionne', 'remises_carburants', 'labels', 'data',"remises_carburants_graphiques"));
    }

    function storeVehicule(Request $request)
    {

        $request->validate(['immatriculation' => 'required|unique:conso_vehicules', 'marque' => 'required', 'nom' => 'required']);
        ConsoVehicule::create($request->all());
        return redirect()->route('vehicules.index')->with('success', 'Véhicule ajouté');
    }
}
