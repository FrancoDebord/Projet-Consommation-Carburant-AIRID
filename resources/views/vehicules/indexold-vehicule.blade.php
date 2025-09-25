@extends('layouts.app')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">Gestion des véhicules</div>
        <div class="card-body">
            {{-- <form method="POST" action="#" class="mb-4"> @csrf
                <div class="row g-3">
                    <div class="col-md-4"><input type="text" name="marque" class="form-control" placeholder="Marque"
                            required></div>
                    <div class="col-md-4"><input type="text" name="modele" class="form-control" placeholder="Modèle"
                            required></div>
                    <div class="col-md-4"><input type="text" name="immatriculation" class="form-control"
                            placeholder="Immatriculation" required></div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
            </form> --}}

            {{-- <form method="POST" action="{{ route('vehicules.store') }}"> @csrf
                <div class="row g-3">
                    <div class="col-md-4"><input type="text" name="immatriculation" class="form-control"
                            placeholder="Immatriculation" required></div>
                    <div class="col-md-4"><input type="text" name="marque" class="form-control" placeholder="Marque"
                            required></div>
                    <div class="col-md-4"><input type="text" name="nom" class="form-control"
                            placeholder="Nom du véhicule" required></div>
                    <div class="col-md-4"><input type="date" name="date_achat" class="form-control"></div>
                    <div class="col-md-4"><input type="number" step="0.01" name="conso_moyenne" class="form-control"
                            placeholder="Conso (L/100km)"></div>
                    <div class="col-md-4"><input type="text" name="type_moteur" class="form-control"
                            placeholder="Type de moteur"></div>
                    <div class="col-md-4"><input type="text" name="type_carburant" class="form-control"
                            placeholder="Type de carburant"></div>
                    <div class="col-md-4"><input type="number" name="kilometrage_actuel" class="form-control"
                            placeholder="Kilométrage actuel"></div>
                    <div class="col-md-12">
                        <textarea name="description" class="form-control" placeholder="Description"></textarea>
                    </div>
                </div>
                <button class="btn btn-success mt-3" type="submit">Enregistrer</button>
            </form> --}}

            <form method="POST" action="{{ route('vehicules.store') }}"> @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Immatriculation</label>
                        <input type="text" name="immatriculation"
                            class="form-control @error('immatriculation') is-invalid @enderror"
                            value="{{ old('immatriculation') }}">
                        @error('immatriculation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Marque</label>
                        <input type="text" name="marque" class="form-control @error('marque') is-invalid @enderror"
                            value="{{ old('marque') }}">
                        @error('marque')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nom du véhicule</label>
                        <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                            value="{{ old('nom') }}">
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Date d'achat</label>
                        <input type="date" name="date_achat"
                            class="form-control @error('date_achat') is-invalid @enderror" value="{{ old('date_achat') }}">
                        @error('date_achat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Consommation (L/100km)</label>
                        <input type="number" step="0.01" name="conso_moyenne"
                            class="form-control @error('conso_moyenne') is-invalid @enderror"
                            value="{{ old('conso_moyenne') }}">
                        @error('conso_moyenne')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Type de moteur</label>
                        <input type="text" name="type_moteur"
                            class="form-control @error('type_moteur') is-invalid @enderror"
                            value="{{ old('type_moteur') }}">
                        @error('type_moteur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Type de carburant</label>
                        <input type="text" name="type_carburant"
                            class="form-control @error('type_carburant') is-invalid @enderror"
                            value="{{ old('type_carburant') }}">
                        @error('type_carburant')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kilométrage actuel</label>
                        <input type="number" name="kilometrage_actuel"
                            class="form-control @error('kilometrage_actuel') is-invalid @enderror"
                            value="{{ old('kilometrage_actuel') }}">
                        @error('kilometrage_actuel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-success mt-3">Enregistrer</button>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Immatriculation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Renault</td>
                        <td>Kangoo</td>
                        <td>AB-123-CD</td>
                        <td><button class="btn btn-sm btn-warning">Modifier</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
