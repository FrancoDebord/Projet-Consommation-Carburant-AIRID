<?php

namespace App\Http\Controllers;

use App\Models\ConsoTypeCarburant;
use Illuminate\Http\Request;

class TypeCarburantController extends Controller
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
        return view('type_carburant.create-type-carburant');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['nom' => 'required', 'prix_station' => 'required']);
        ConsoTypeCarburant::create($request->all());
        return back()->with('success', 'Type de carburant ajouté');
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
