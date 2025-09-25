@extends('layouts.app')
@section('content')
    {{-- <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">Ajouter une remise carburant</div>
        <div class="card-body">
            <form method="POST" action="{{ route('carburants.store') }}" enctype="multipart/form-data"> @csrf
                <div class="mb-3"><input type="number" name="kilometrage_depart" class="form-control"
                        placeholder="Kilométrage départ" ></div>
                <div class="mb-3"><input type="number" step="0.01" name="montant_carburant_remis" class="form-control"
                        placeholder="Montant remis" ></div>
                <div class="mb-3"><input type="date" name="date_remise" class="form-control" ></div>
                <div class="mb-3"><input type="file" name="image_kilometrage_depart" class="form-control"></div>
                <div class="mb-3"><input type="text" name="remis_par" class="form-control" placeholder="Remis par"
                        ></div>
                <div class="mb-3">
                    <select name="observation" class="form-control">
                        <option value="ticket_valeur">Ticket-Valeur</option>
                        <option value="espece">Espèce</option>
                        <option value="momo">Mobile Money</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select name="mission_id" class="form-control">
                        @foreach ($missions as $mission)
                            <option value="{{ $mission->id }}">{{ $mission->objet }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success">Enregistrer</button>
            </form>

         
        </div>
    </div> --}}

    <form method="POST" action="{{ route('carburants.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-gas-pump me-2"></i> Enregistrement d’un carburant</h5>
            </div>

            <div class="card-body">
                <div class="row g-3">

                    {{-- Kilométrage départ --}}
                    <div class="col-12 col-md-4 mb-3 form-group">
                        @php
                            $kilometrage_depart = '';

                            if (old('kilometrage_depart')) {
                                $kilometrage_depart = old('kilometrage_depart');
                            } elseif ($carburant_mission) {
                                $kilometrage_depart = $carburant_mission->kilometrage_depart;
                            }
                        @endphp

                            <label for="kilometrage_depart" class="form-label"><strong>Kilométrage départ <span
                                        class="text-danger">(*)</span></strong></label>
                        <input type="number" id="kilometrage_depart" name="kilometrage_depart"
                            class="form-control @error('kilometrage_depart') is-invalid @enderror"
                            value="{{ $kilometrage_depart }}" >
                        @error('kilometrage_depart')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Montant remis --}}
                    <div class="col-12 col-md-4 mb-3 form-group">
                        <label for="montant_carburant_remis" class="form-label"><strong>Montant remis en FCFA<span
                                    class="text-danger"> (*)</span></strong></label>

                        @php
                            $montant_carburant_remis = '';

                            if (old('montant_carburant_remis')) {
                                $montant_carburant_remis = old('montant_carburant_remis');
                            } elseif ($carburant_mission) {
                                $montant_carburant_remis = $carburant_mission->montant_carburant_remis;
                            }
                        @endphp

                        <input type="number" step="0.01" id="montant_carburant_remis" name="montant_carburant_remis"
                            class="form-control @error('montant_carburant_remis') is-invalid @enderror"
                            value="{{ $montant_carburant_remis }}" >
                        @error('montant_carburant_remis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Date de remise --}}
                    <div class="col-12 col-md-4 mb-3 form-group">
                        <label for="date_remise" class="form-label"><strong>Date de remise du carburant <span
                                    class="text-danger">(*)</span></strong></label>
                        @php
                            $date_remise = '';

                            if (old('date_remise')) {
                                $date_remise = old('date_remise');
                            } elseif ($carburant_mission) {
                                $date_remise = $carburant_mission->date_remise;
                            }
                        @endphp

                        <input type="date" id="date_remise" name="date_remise"
                            class="form-control @error('date_remise') is-invalid @enderror" value="{{ $date_remise }}"
                            >
                        @error('date_remise')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Image kilométrage départ --}}
                    <div class="col-12 col-md-4 mb-3 form-group">
                        <label for="image_kilometrage_depart" class="form-label">
                            <strong> Image du kilométrage <span
                                    class="text-danger">(*)</span></strong></label>
                           
                            </label>
                        @php
                            $image_kilometrage_depart = '';

                            if (old('image_kilometrage_depart')) {
                                $image_kilometrage_depart = old('image_kilometrage_depart');
                            } elseif ($carburant_mission) {
                                $image_kilometrage_depart = $carburant_mission->image_kilometrage_depart;
                            }
                        @endphp

                        <input type="file" id="image_kilometrage_depart" name="image_kilometrage_depart"
                            class="form-control @error('image_kilometrage_depart') is-invalid @enderror">
                        @error('image_kilometrage_depart')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remis par --}}
                    <div class="col-12 col-md-4 mb-3 form-group">

                        @php
                            $remis_par = '';

                            if (old('remis_par')) {
                                $remis_par = old('remis_par');
                            } elseif ($carburant_mission) {
                                $remis_par = $carburant_mission->remis_par;
                            }
                        @endphp

                        <label for="remis_par" class="form-label"><strong>Remis par <span
                                    class="text-danger">(*)</span></strong></label>
                       

                        <select name="remis_par" id="remis_par"
                            class="form-control selectpicker  show-tick  @error('remis_par') is-invalid @enderror"
                            value="{{ old('remis_par') }}" data-live-search="true">
                            <option value="">Sélectionner </option>

                            @forelse ($all_personnels??[] as $personnel)
                                <option {{ $remis_par == $personnel->id ? 'selected' : '' }} value="{{ $personnel->id }}">
                                    {{ $personnel->titre . ' ' . $personnel->prenom . ' ' . $personnel->nom }}
                                </option>
                            @empty
                            @endforelse
                        </select>

                        @error('remis_par')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Observation --}}
                    <div class="col-12 col-md-4 mb-3 form-group">
                        <label for="observation" class="form-label"><strong>Observation <span
                                    class="text-danger">(*)</span></strong></label>
                        @php
                            $observation = '';

                            if (old('observation')) {
                                $observation = old('observation');
                            } elseif ($carburant_mission) {
                                $observation = $carburant_mission->observation;
                            }
                        @endphp

                        <select id="observation" name="observation"
                            class="form-control selectpicker show-tick @error('observation') is-invalid @enderror"
                            data-live-search="true">
                            <option value="ticket_valeur" {{ $observation == 'ticket_valeur' ? 'selected' : '' }}>
                                Ticket-Valeur
                            </option>
                            <option value="espece" {{ $observation == 'espece' ? 'selected' : '' }}>Espèce
                            </option>
                            <option value="momo" {{ $observation == 'momo' ? 'selected' : '' }}>Mobile
                                Money</option>
                        </select>
                        @error('observation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Mission --}}
                    <div class="col-12 col-md-4 mb-3 form-group">
                        @php
                            $mission_id = '';

                            if (old('mission_id')) {
                                $mission_id = old('mission_id');
                            } elseif ($carburant_mission) {
                                $mission_id = $carburant_mission->mission_id;
                            }
                        @endphp

                        <label for="mission_id" class="form-label"><strong>Mission <span
                                    class="text-danger">(*)</span></strong></label>
                        <select id="mission_id" name="mission_id"
                            class="form-control selectpicker show-tick @error('mission_id') is-invalid @enderror"
                            data-live-search="true">
                            @foreach ($missions as $mission)
                                <option value="{{ $mission->id }}" {{ $mission_id == $mission->id ? 'selected' : '' }}>
                                    {{ $mission->objet }}
                                </option>
                            @endforeach
                        </select>
                        @error('mission_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Enregistrer
                </button>
            </div>
        </div>
    </form>
@endsection
