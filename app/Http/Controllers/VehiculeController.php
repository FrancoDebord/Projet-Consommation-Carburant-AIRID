<?php

namespace App\Http\Controllers;

use App\Models\ConsoTypeCarburant;
use App\Models\ConsoVehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("vehicules.index-vehicule", ['vehicules' => ConsoVehicule::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $all_types_carburants = ConsoTypeCarburant::all();
        $vehicule = new ConsoVehicule();

        return view("vehicules.create-vehicule", compact("all_types_carburants", "vehicule"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'immatriculation' => 'required|unique:conso_vehicules',
                'marque' => 'required',
                'conso_moyenne' => 'required|numeric',
                'nom' => 'required',
                'type_carburant_id' => 'required',
                'type_moteur' => 'required'
            ]
        );
        ConsoVehicule::create($request->all());
        return redirect()->route('vehicules.index')->with('success', 'Véhicule ajouté');
    }

    /**
     * Display the specified resource.
     */
    public function show(ConsoVehicule $consoVehicule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //

        $all_types_carburants = ConsoTypeCarburant::all();
        $vehicule = ConsoVehicule::find($id);

        return view("vehicules.create-vehicule", compact("all_types_carburants", "vehicule"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {

        $request->validate(
            [
                'immatriculation' => 'required|exists:conso_vehicules',
                'marque' => 'required',
                'conso_moyenne' => 'required|numeric',
                'nom' => 'required',
                'type_carburant_id' => 'required',
                'type_moteur' => 'required'
            ]
        );

        $vehicule = ConsoVehicule::find($id);
        $vehicule->update($request->all());
        return redirect()->route('vehicules.index')->with('success', 'Véhicule modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsoVehicule $consoVehicule)
    {
        //
    }
}
