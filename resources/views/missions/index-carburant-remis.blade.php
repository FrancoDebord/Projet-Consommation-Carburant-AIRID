@extends('layouts.app')
@section('content')
    <div class="row mt-5">


        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">Détail de la mission sélectionnée</div>
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
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{ $mission->objet }}</td>
                                <td>{{ $mission->date_debut }}</td>
                                <td>{{ $mission->date_fin }}</td>
                                <td>{{ '??' }}</td>
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

                               
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
            <h3>Liste des approvisionnements en carburant pour cette mission</h3>
            <a href="{{ route('carburants.create',['mission_id'=>request("mission_id")]) }}" class="btn btn-primary">+ Ajouter un approvisionnement</a>
        </div>
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Liste des remises de carburant</div>
                <div class="card-body">
                    <table id="carburantsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date de remise</th>
                                <th>Montant Remis</th>
                                <th>Observation</th>
                                <th>Qui a remis</th>
                                <th>Kilométrage à la rémise</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($all_carburants_mission??[] as $carburant)
                                <tr>
                                    <td>{{ $carburant->date_remise }}</td>
                                    <td>{{ number_format($carburant->montant_carburant_remis , 2," ")}} FCFA</td>
                                    <td>{{ Str::upper($carburant->observation) }}</td>
                                    @php
                                        $qui_a_remis = $carburant->quiARemis;
                                    @endphp
                                    <td>{{ $qui_a_remis ? $qui_a_remis->titre . ' ' . $qui_a_remis->prenom . ' ' . $qui_a_remis->nom : 'Unknown' }}
                                    <td>{{ $carburant->kilometrage_depart }} KM</td>



                                    <td>
                                        <a href="{{ route('carburants.edit', ['carburant' => $carburant]) }}"
                                            class="btn btn-sm btn-outline-warning">
                                            <i class="fa fa-edit">&nbsp;</i>
                                        </a>
                                        <a href="{{ route('carburants.edit', ['carburant' => $carburant]) }}"
                                            class="btn btn-sm btn-outline-danger">
                                            <i class="fa fa-trash-alth">&nbsp;</i>
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
            $('#carburantsTable').DataTable();
        });
    </script>
@endpush
