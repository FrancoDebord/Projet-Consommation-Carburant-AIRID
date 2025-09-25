<?php

namespace App\Http\Controllers;

use App\Models\ConsoVehicule;
use Illuminate\Http\Request;

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

    function storeVehicule(Request $request)
    {

        $request->validate(['immatriculation' => 'required|unique:conso_vehicules', 'marque' => 'required', 'nom' => 'required']);
        ConsoVehicule::create($request->all());
        return redirect()->route('vehicules.index')->with('success', 'Véhicule ajouté');
    }
}
