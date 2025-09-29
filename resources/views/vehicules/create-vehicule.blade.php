@extends('layouts.app')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">Ajouter un véhicule</div>
        <div class="card-body">

            @php
                $route = $vehicule->id ? route('vehicules.update', $vehicule->id) : route('vehicules.store');
            @endphp
            <form method="POST" action="{{ $route }}">

                @csrf
                <input type="hidden" name="_method" value="{{ $vehicule->id ? 'PUT' : 'POST' }}">
                <div class="row g-3">
                    <div class="col-md-4">

                        @php
                            $immatriculation = '';

                            if (old('immatriculation')) {
                                $immatriculation = old('immatriculation');
                            } elseif ($vehicule) {
                                $immatriculation = $vehicule->immatriculation;
                            }
                        @endphp

                        <label class="form-label"><strong>Immatriculation du véhicule<span
                                    class="text-danger">(*)</span></strong></label>
                        <input type="text" name="immatriculation"
                            class="form-control @error('immatriculation') is-invalid @enderror"
                            value="{{ $immatriculation }}">
                        @error('immatriculation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><strong>Marque du véhicule <span
                                    class="text-danger">(*)</span></strong></label>

                        @php
                            $marque = '';

                            if (old('marque')) {
                                $marque = old('marque');
                            } elseif ($vehicule) {
                                $marque = $vehicule->marque;
                            }
                        @endphp
                        <select name="marque" id="marque"
                            class="form-control selectpicker show-tick @error('marque') is-invalid @enderror "
                            data-live-search="true">
                            <option value="TOYOTA" {{ $marque == 'TOYOTA' ? 'selected' : '' }}>TOYOTA</option>
                            <option value="HUNDAI" {{ $marque == 'HUNDAI' ? 'selected' : '' }}>HUNDAI</option>
                        </select>

                        @error('marque')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">

                        @php
                            $nom = '';

                            if (old('nom')) {
                                $nom = old('nom');
                            } elseif ($vehicule) {
                                $nom = $vehicule->nom;
                            }
                        @endphp
                        <label class="form-label"><strong>Nom du véhicule <span
                                    class="text-danger">(*)</span></strong></label>
                        <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                            value="{{ $nom }}">
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        @php
                            $numero_chassis = '';

                            if (old('numero_chassis')) {
                                $numero_chassis = old('numero_chassis');
                            } elseif ($vehicule) {
                                $numero_chassis = $vehicule->numero_chassis;
                            }
                        @endphp

                        <label class="form-label"><strong>Numéro du chassis <span
                                    class="text-danger">(Optionnel)</span></strong></label>
                        <input type="text" name="numero_chassis"
                            class="form-control @error('numero_chassis') is-invalid @enderror"
                            value="{{ $numero_chassis }}">
                        @error('numero_chassis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">

                        @php
                            $date_achat = '';

                            if (old('date_achat')) {
                                $date_achat = old('date_achat');
                            } elseif ($vehicule) {
                                $date_achat = $vehicule->date_achat;
                            }
                        @endphp

                        <label class="form-label"><strong>Date d'achat <span
                                    class="text-danger">(Optionnel)</span></strong></label>
                        <input type="date" name="date_achat"
                            class="form-control @error('date_achat') is-invalid @enderror" value="{{ $date_achat }}">
                        @error('date_achat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"> <strong>Consommation (L/100km) <span
                                    class="text-danger">(*)</span></strong></label>
                        @php
                            $conso_moyenne = '';

                            if (old('conso_moyenne')) {
                                $conso_moyenne = old('conso_moyenne');
                            } elseif ($vehicule) {
                                $conso_moyenne = $vehicule->conso_moyenne;
                            }
                        @endphp

                        <input type="number" step="0.01" name="conso_moyenne"
                            class="form-control @error('conso_moyenne') is-invalid @enderror" value="{{ $conso_moyenne }}">
                        @error('conso_moyenne')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">

                        @php
                            $type_moteur = '';

                            if (old('type_moteur')) {
                                $type_moteur = old('type_moteur');
                            } elseif ($vehicule) {
                                $type_moteur = $vehicule->type_moteur;
                            }
                        @endphp

                        <label class="form-label"> <strong>Type de moteur <span
                                    class="text-danger">(*)</span></strong></label>
                        <select name="type_moteur" id="type_moteur"
                            class=" selectpicker show-tick form-control @error('type_moteur') is-invalid @enderror "
                            data-live-search="true">
                            <option value="V4" {{ $type_moteur == 'V4' ? 'selected' : '' }}>V4</option>
                            <option value="V6" {{ $type_moteur == 'V6' ? 'selected' : '' }}>V6</option>
                            <option value="V8" {{ $type_moteur == 'V8' ? 'selected' : '' }}>V8</option>
                        </select>
                        @error('type_moteur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-4">

                        @php
                            $type_carburant_id = '';

                            if (old('type_carburant_id')) {
                                $type_carburant_id = old('type_carburant_id');
                            } elseif ($vehicule) {
                                $type_carburant_id = $vehicule->type_carburant_id;
                            }
                        @endphp

                        <label class="form-label" for="type_carburant_id"> <strong>Type de carburant <span
                                    class="text-danger">(*)</span></strong></label>

                        <select name="type_carburant_id" id="type_carburant_id"
                            class=" selectpicker show-tick form-control @error('type_carburant_id') is-invalid @enderror "data-live-search="true">

                            <option value="">Sélectionner</option>
                            @forelse ($all_types_carburants??[] as $type_carburant)
                                <option value="{{ $type_carburant->id }}"
                                    {{ $type_carburant_id == $type_carburant->id ? 'selected' : '' }}>
                                    {{ Str::upper($type_carburant->nom) }}</option>
                            @empty
                            @endforelse

                        </select>
                        @error('type_carburant_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">

                        @php
                            $description = '';

                            if (old('description')) {
                                $description = old('description');
                            } elseif ($vehicule) {
                                $description = $vehicule->description;
                            }
                        @endphp
                        <label class="form-label"> <strong>Description <span
                                    class="text-danger">(Optionnel)</span></strong></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ $description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-success mt-3">Enregistrer</button>
            </form>
        </div>
    </div>
@endsection
