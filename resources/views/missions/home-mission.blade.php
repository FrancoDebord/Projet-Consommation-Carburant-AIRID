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

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Liste des missions</h3>
            <a href="{{ route('missions.create') }}" class="btn btn-primary">+ Programmer une mission</a>
        </div>
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">Liste des missions récentes</div>
                <div class="card-body">
                    <table id="missionsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Objet Mission</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>Durée</th>
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
                                    <td>{{ "??" }}</td>
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

                                    <td>
                                        <a href="{{ route('missions.edit', ['mission' => $mission]) }}"
                                            class="btn btn-sm btn-outline-warning">
                                            <i class="fa fa-edit">&nbsp;</i>
                                        </a>
                                        <a href="{{ route("carburants.index",["mission_id"=>$mission->id]) }}" class="btn btn-sm btn-outline-info">
                                            <i class="fa fa-money">&nbsp;</i>  Carburants
                                        </a>
                                    </td>
                                    <td>
                                         <a href="#" class="btn btn-sm btn-outline-success">
                                            <i class="fa fa-money">&nbsp;</i> Marquer fin de mission
                                        </a>
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
