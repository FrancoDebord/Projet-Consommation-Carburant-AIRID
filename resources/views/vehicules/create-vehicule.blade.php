@extends('layouts.app')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">Ajouter un véhicule</div>
        <div class="card-body">
            <form method="POST" action="{{ route('vehicules.store') }}"> @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label"><strong>Immatriculation du véhicule<span
                                    class="text-danger">(*)</span></strong></label>
                        <input type="text" name="immatriculation"
                            class="form-control @error('immatriculation') is-invalid @enderror"
                            value="{{ old('immatriculation') }}">
                        @error('immatriculation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><strong>Marque du véhicule <span
                                    class="text-danger">(*)</span></strong></label>
                        <select name="marque" id="marque"
                            class="form-control selectpicker show-tick @error('marque') is-invalid @enderror " data-live-search="true">
                            <option value="TOYOTA">TOYOTA</option>
                            <option value="HUNDAI">HUNDAI</option>
                        </select>

                        @error('marque')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><strong>Nom du véhiclule <span
                                    class="text-danger">(*)</span></strong></label>
                        <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                            value="{{ old('nom') }}">
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><strong>Numéro du chassis <span
                                    class="text-danger">(Optionnel)</span></strong></label>
                        <input type="text" name="numero_chassis" class="form-control @error('numero_chassis') is-invalid @enderror"
                            value="{{ old('numero_chassis') }}">
                        @error('numero_chassis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><strong>Date d'achat <span
                                    class="text-danger">(Optionnel)</span></strong></label>
                        <input type="date" name="date_achat"
                            class="form-control @error('date_achat') is-invalid @enderror" value="{{ old('date_achat') }}">
                        @error('date_achat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"> <strong>Consommation (L/100km) <span
                                    class="text-danger">(*)</span></strong></label>
                        <input type="number" step="0.01" name="conso_moyenne"
                            class="form-control @error('conso_moyenne') is-invalid @enderror"
                            value="{{ old('conso_moyenne') }}">
                        @error('conso_moyenne')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"> <strong>Type de moteur <span
                                    class="text-danger">(*)</span></strong></label>
                       <select name="type_moteur" id="type_moteur"
                            class=" selectpicker show-tick form-control @error('type_moteur') is-invalid @enderror " data-live-search="true">
                            <option value="V4">V4</option>
                            <option value="V6">V6</option>
                            <option value="V8">V8</option>
                        </select>
                        @error('type_moteur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"> <strong>Type de carburant <span
                                    class="text-danger">(*)</span></strong></label>

                        <select name="type_carburant" id="type_carburant"
                            class=" selectpicker show-tick form-control @error('type_carburant') is-invalid @enderror "data-live-search="true">
                            <option value="essence">Essence</option>
                            <option value="gaz-oil">Gaz-Oil</option>
                        </select>
                        @error('type_carburant')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="col-md-4">
                        <label class="form-label">Kilométrage actuel</label>
                        <input type="number" name="kilometrage_actuel"
                            class="form-control @error('kilometrage_actuel') is-invalid @enderror"
                            value="{{ old('kilometrage_actuel') }}">
                        @error('kilometrage_actuel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="col-md-12">
                        <label class="form-label"> <strong>Description  <span
                                    class="text-danger">(Optionnel)</span></strong></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
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
