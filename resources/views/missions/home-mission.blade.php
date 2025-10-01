@extends('layouts.app')
@section('content')
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card card-kpi text-center p-3">
                <h5>Missions en cours</h5>
                <h3>8</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-kpi text-center p-3">
                <h5>Missions terminées</h5>
                <h3>117</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-kpi text-center p-3">
                <h5>Missions à venir</h5>
                <h3>12</h3>
            </div>
        </div>
    </div>




    <div class="row mt-5">

        @if (session('success'))
            <div class="d-flex">
                <p class="alert alert-success text-center">
                    {{ session('success') }}
                </p>
            </div>
        @endif

        @if (session('error'))
            <div class="d-flex">
                <p class="alert alert-success text-center">
                    {{ session('success') }}
                </p>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Liste des missions</h3>
            <a href="{{ route('missions.create') }}" class="btn btn-primary">+ Programmer une mission</a>
        </div>
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">Liste des missions récentes</div>
                <div class="card-body table-responsive">
                    <table id="missionsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Objet Mission</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>Lieu</th>
                                <th>Véhicule</th>
                                <th>Chef Mission</th>
                                <th>Chauffeur</th>
                                <th>Actions</th>
                                <th>Fin Mission</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($missions??[] as $mission)
                                <tr>
                                    <td>{{ $mission->objet }}</td>
                                    <td>{{ $mission->date_debut }}</td>
                                    <td>{{ $mission->date_fin }}</td>

                                    <td>{{ $mission->lieu }}</td>

                                    @php
                                        $vehicule = $mission->vehicule;
                                        $chef_mission = $mission->chefMission;
                                        $chauffeurMission = $mission->chauffeurMission;
                                    @endphp
                                    <td>{{ $vehicule ? $vehicule->nom : 'N/A' }} -
                                        {{ $vehicule ? $vehicule->immatriculation : '' }}</td>
                                    <td>{{ $chef_mission ? $chef_mission->titre . ' ' . $chef_mission->prenom . ' ' . $chef_mission->nom : 'Unknown' }}
                                    </td>
                                    <td>{{ $chauffeurMission ? $chauffeurMission->titre . ' ' . $chauffeurMission->prenom . ' ' . $chauffeurMission->nom : 'Unknown' }}
                                    </td>

                                    <td class="">

                                        <a href="{{ route('carburants.index', ['mission_id' => $mission->id]) }}"
                                            class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-gas-pump">&nbsp;</i> 
                                        </a>
                                        <a href="{{ route('missions.edit', ['mission' => $mission]) }}"
                                            class="btn btn-sm btn-outline-warning">
                                            <i class="fa fa-edit">&nbsp;</i>
                                        </a>
                                        @if ($mission->carburants->count() > 0)
                                            <a href="#"
                                                class=" btn btn-sm btn-danger supprimer-mission mt-2"
                                                data-mission-id="{{ $mission->id }}">
                                                <i class="fa fa-trash">&nbsp;</i>
                                            </a>
                                        @endif



                                    </td>
                                    <td>
                                        @if ($mission->etat == 'en_cours')
                                            <a href="#"
                                                class="btn btn-sm btn-outline-success -mb-pxx marquer-mission-terminee"
                                                data-mission-id="{{ $mission->id }}">
                                                Marquer fin de mission
                                            </a>
                                        @else
                                            <a href="#"
                                                class="btn btn-sm btn-outline-danger -mb-pxx restaurer-mission"
                                                data-mission-id="{{ $mission->id }}">
                                                Restaurer mission
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#missionsTable').DataTable();
        });
    </script>
@endpush
