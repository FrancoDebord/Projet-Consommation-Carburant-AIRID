@extends('layouts.app')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">Créer une mission</div>
        <div class="card-body">

            @if (session("success"))
                <div class="row">
                    <div class="d-flex">
                        <p class="alert alert-success text-center">
                            {{ session("success") }}
                        </p>
                    </div>
                </div>
            @endif
            @php
                $route = $mission->id ? route("missions.update",["mission"=>$mission]):route("missions.store");
            @endphp

            <form method="POST" action="{{ $route }}">
                @csrf

                <input type="hidden" name="_method" value="{{ $mission->id?"PUT":"POST" }}">
                {{-- Objet --}}

                @php
                    $objet = '';

                    if (old('objet')) {
                        $objet = old('objet');
                    } elseif ($mission) {
                        $objet = $mission->objet;
                    }
                @endphp
                <div class="mb-3 form-group col-12">
                    <label for="objet" class="form-label">
                        <strong>Objet de la mission <span class="text-danger">(*)</span></strong>
                    </label>
                    <input type="text" id="objet" name="objet"
                        class="form-control @error('objet') is-invalid @enderror" value="{{ $objet }}" required>
                    @error('objet')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Date début --}}


                    @php
                        $date_debut = '';

                        if (old('date_debut')) {
                            $date_debut = old('date_debut');
                        } elseif ($mission) {
                            $date_debut = $mission->date_debut;
                        }
                    @endphp

                    <div class="mb-3 col-12 col-md-4 form-group">
                        <label for="date_debut" class="form-label">
                            <strong>Date de début <span class="text-danger">(*)</span></strong>
                        </label>
                        <input type="date" id="date_debut" name="date_debut"
                            class="form-control @error('date_debut') is-invalid @enderror" value="{{ $date_debut }}"
                            required>
                        @error('date_debut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Date fin --}}
                    <div class="mb-3 col-12 col-md-4 form-group">

                        @php
                            $date_fin = '';

                            if (old('date_fin')) {
                                $date_fin = old('date_fin');
                            } elseif ($mission) {
                                $date_fin = $mission->date_fin;
                            }
                        @endphp

                        <label for="date_fin" class="form-label">
                            <strong>Date de fin <span class="text-danger">(*)</span></strong>
                        </label>
                        <input type="date" id="date_fin" name="date_fin"
                            class="form-control @error('date_fin') is-invalid @enderror" value="{{ $date_fin }}">
                        @error('date_fin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Lieu --}}
                    <div class="mb-3 col-12 col-md-4 form-group">

                        @php
                            $lieu = '';

                            if (old('lieu')) {
                                $lieu = old('lieu');
                            } elseif ($mission) {
                                $lieu = $mission->lieu;
                            }
                        @endphp

                        <label for="lieu" class="form-label">
                            <strong>Lieu de la mission <span class="text-danger">(*)</span></strong>
                        </label>
                        <input type="text" id="lieu" name="lieu"
                            class="form-control @error('lieu') is-invalid @enderror" value="{{ $lieu }}">
                        @error('lieu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Type de mission --}}
                    <div class="mb-3 col-12 col-md-4 form-group">

                        @php
                            $type_mission = '';

                            if (old('type_mission')) {
                                $type_mission = old('type_mission');
                            } elseif ($mission) {
                                $type_mission = $mission->type_mission;
                            }
                        @endphp
                        <label for="type_mission" class="form-label">
                            <strong>Type de mission <span class="text-danger">(*)</span></strong>
                        </label>
                        <select id="type_mission" name="type_mission"
                            class="form-control selectpicker  show-tick  @error('type_mission') is-invalid @enderror"
                            data-live-search="true">
                            <option value="longue_duree" {{ $type_mission == 'longue_duree' ? 'selected' : '' }}>
                                Longue durée
                            </option>
                            <option value="course_ville" {{ $type_mission == 'course_ville' ? 'selected' : '' }}>
                                Course en ville
                            </option>
                        </select>
                        @error('type_mission')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- État --}}
                    <div class="mb-3 col-12 col-md-4 form-group">

                        @php
                            $etat = '';

                            if (old('etat')) {
                                $etat = old('etat');
                            } elseif ($mission) {
                                $etat = $mission->etat;
                            }
                        @endphp

                        <label for="etat" class="form-label">
                            <strong>Statut de la mission <span class="text-danger">(*)</span></strong>
                        </label>
                        <select id="etat" name="etat"
                            class="form-control  selectpicker  show-tick  @error('etat') is-invalid @enderror"
                            data-live-search="true">
                            <option value="en_cours" {{ $etat == 'en_cours' ? 'selected' : '' }}>En cours</option>
                            <option value="suspendu" {{ $etat == 'suspendu' ? 'selected' : '' }}>Suspendu</option>
                            <option value="termine" {{ $etat == 'termine' ? 'selected' : '' }}>Terminé</option>
                        </select>
                        @error('etat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Chauffeur --}}
                    <div class="mb-3 col-12 col-md-4 form-group">

                        @php
                            $chauffeur = '';

                            if (old('chauffeur')) {
                                $chauffeur = old('chauffeur');
                            } elseif ($mission) {
                                $chauffeur = $mission->chauffeur;
                            }
                        @endphp

                        <label for="chauffeur" class="form-label">
                            <strong>Chauffeur de la mission <span class="text-danger">(*)</span></strong>
                        </label>
                        <select name="chauffeur" id="chauffeur"
                            class="form-control selectpicker  show-tick  @error('chauffeur') is-invalid @enderror"
                            value="{{ old('chauffeur') }}" data-live-search="true">
                            <option value="">Sélectionner </option>

                            @forelse ($all_personnels??[] as $personnel)
                                <option {{ $chauffeur == $personnel->id ? 'selected' : '' }} value="{{ $personnel->id }}">
                                    {{ $personnel->titre . ' ' . $personnel->prenom . ' ' . $personnel->nom }}</option>
                            @empty
                            @endforelse
                        </select>

                        @error('chauffeur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Chef de mission --}}
                    <div class="mb-3 col-12 col-sm-6 form-group">

                        @php
                            $chef_mission = '';

                            if (old('chef_mission')) {
                                $chef_mission = old('chef_mission');
                            } elseif ($mission) {
                                $chef_mission = $mission->chef_mission;
                            }
                        @endphp
                        <label for="chef_mission" class="form-label">
                            <strong>Chef de la mission <span class="text-danger">(*)</span></strong>
                        </label>
                        <select name="chef_mission" id="chef_mission"
                            class="form-control selectpicker  show-tick @error('chef_mission') is-invalid @enderror"
                            value="{{ old('chef_mission') }}" data-live-search="true">
                            <option value="">Sélectionner </option>

                            @forelse ($all_personnels??[] as $personnel)
                                <option {{ $chef_mission == $personnel->id ? 'selected' : '' }}
                                    value="{{ $personnel->id }}">
                                    {{ $personnel->titre . ' ' . $personnel->prenom . ' ' . $personnel->nom }}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('chef_mission')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    {{-- Véhicule --}}
                    <div class="mb-3 col-12 col-sm-6  form-group">

                        @php
                            $vehicule_id = '';

                            if (old('vehicule_id')) {
                                $vehicule_id = old('vehicule_id');
                            } elseif ($mission) {
                                $vehicule_id = $mission->vehicule_id;
                            }
                        @endphp
                        <label for="vehicule_id" class="form-label">Véhicule</label>
                        <select id="vehicule_id" name="vehicule_id"
                            class="form-control selectpicker  show-tick @error('vehicule_id') is-invalid @enderror"
                            data-live-search="true">

                            <option value="">selectionner</option>
                            @foreach ($vehicules ?? [] as $vehicule)
                                <option {{ $vehicule_id == $vehicule->id ? 'selected' : '' }} value="{{ $vehicule->id }}"
                                    {{ old('vehicule_id') == $vehicule->id ? 'selected' : '' }}>
                                    {{ $vehicule->nom }} - {{ $vehicule->immatriculation }}
                                </option>
                            @endforeach
                        </select>
                        @error('vehicule_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- detail_mission --}}
                    <div class="mb-3 col-12 form-group">

                        @php
                            $description = '';

                            if (old('description')) {
                                $description = old('description');
                            } elseif ($mission) {
                                $description = $mission->description;
                            }
                        @endphp

                        <label for="description" class="form-label">Plus de détails (optionnel)</label>

                        <textarea name="description" id="" cols="30" rows="10"
                            class="form-control @error('description') is-invalid @enderror">{{ $description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Bouton --}}
                <button type="submit" class="btn btn-success">Créer</button>
            </form>

        </div>
    </div>
@endsection
