<?php

namespace App\Http\Controllers;

use App\Models\ConsoVehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("vehicules.index-vehicule",['vehicules' => ConsoVehicule::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view("vehicules.create-vehicule");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
           $request->validate(
            ['immatriculation' => 'required|unique:conso_vehicules', 
            'marque' => 'required', 
            'conso_moyenne' => 'required|numeric', 
            'nom' => 'required',
            'type_carburant' => 'required',
            'type_moteur' => 'required'
        ]);
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
    public function edit(ConsoVehicule $consoVehicule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConsoVehicule $consoVehicule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsoVehicule $consoVehicule)
    {
        //
    }
}
