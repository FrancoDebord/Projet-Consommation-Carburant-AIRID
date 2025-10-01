{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        {{-- SECTION 1 : Filtres de recherche --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Critères de recherche</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="#" class="row g-3">
                    <div class="col-md-3">
                        <label for="vehicule" class="form-label">Véhicule</label>
                        @php
                            $vehicule_id = request()->get('vehicule_id');

                        @endphp
                        <select class="form-select" id="vehicule" name="vehicule_id">
                            <option value="">-- Sélectionner --</option>
                            @foreach ($all_vehicules as $vehicule)
                                <option value="{{ $vehicule->id }}" {{ $vehicule_id == $vehicule->id ? 'selected' : '' }}>
                                    {{ $vehicule->nom }} - {{ $vehicule->immatriculation }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="mission" class="form-label">Mission</label>
                        @php
                            $mission_id = request()->get('mission_id');
                        @endphp
                        <select class="form-select" id="mission" name="mission_id">
                            <option value="">-- Sélectionner --</option>
                            @foreach ($all_missions as $mission)
                                <option value="{{ $mission->id }}" {{ $mission_id == $mission->id ? 'selected' : '' }}>
                                    {{ $mission->objet }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="mois" class="form-label">Mois</label>
                        @php
                            $mois = request()->get('mois');
                        @endphp
                        <select class="form-select" id="mois" name="mois">
                            <option value="">-- Tous --</option>
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ $mois == $m ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="annee" class="form-label">Année</label>

                        @php
                            $annee = request()->get('annee');
                        @endphp
                        <select class="form-select" id="annee" name="annee">
                            <option value="">-- Toutes --</option>
                            @for ($y = date('Y'); $y >= 2000; $y--)
                                <option value="{{ $y }}" {{ $annee == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </div>
            
                    <div class="col-md-3">
                        <label class="form-label">Période (Début)</label>
                        @php
                            $date_debut = request()->get('date_debut');
                            $date_fin = request()->get('date_fin');
                        @endphp
                        <input type="date" class="form-control" name="date_debut" value="{{ $date_debut }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Période (Fin)</label>
                        <input type="date" class="form-control" name="date_fin" value="{{ $date_fin }}">
                    </div>
                    <div class="col-md-3 align-self-end">
                        <button type="submit" class="btn btn-success w-100">Filtrer</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="printableArea">
            {{-- SECTION 2 : Informations techniques véhicule --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Informations techniques du véhicule</h5>
                </div>
                <div class="card-body">
                    @if (isset($vehiculeSelectionne))
                        <table class="table table-bordered">
                            <tr>
                                <th>Immatriculation</th>
                                <td>{{ $vehiculeSelectionne->immatriculation }}</td>
                            </tr>
                            <tr>
                                <th>Marque</th>
                                <td>{{ $vehiculeSelectionne->marque }}</td>
                            </tr>
                            <tr>
                                <th>Nom</th>
                                <td>{{ $vehiculeSelectionne->nom }}</td>
                            </tr>
                            <tr>
                                <th>Date d'achat</th>
                                <td>{{ $vehiculeSelectionne->date_achat }}</td>
                            </tr>
                            <tr>
                                <th>Type moteur</th>
                                <td>{{ $vehiculeSelectionne->type_moteur }}</td>
                            </tr>
                            <tr>
                                <th>Carburant</th>
                                <td>{{ $vehiculeSelectionne->typeCarburant->nom }}</td>
                            </tr>
                            <tr>
                                <th>Consommation sur 100Km</th>
                                <td>{{ $vehiculeSelectionne->conso_moyenne }} Litres</td>
                            </tr>
                        </table>
                    @else
                        <p class="text-muted">Veuillez sélectionner un véhicule pour afficher ses informations.</p>
                    @endif
                </div>
            </div>

            {{-- SECTION 3 : Tableau des remises carburant --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Remises de carburant</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Montant remis</th>
                                <th>Kilométrage départ</th>
                                <th>Mission</th>
                                <th>Remis par</th>
                                <th>Observation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($remises_carburants as $remise)
                                <tr>
                                    <td>{{ date("Y-m-d", strtotime($remise->date_remise)) }}</td>
                                    <td>{{ number_format($remise->montant_carburant_remis, 0, ',', ' ') }} FCFA</td>
                                    <td>{{ number_format($remise->kilometrage_depart, 0, ',', ' ') }} Km</td>
                                    <td>{{ $remise->mission->objet ?? 'Course de semaine' }}</td>

                                    @php
                                        $qui_a_remis = $remise->quiARemis; // Relation définie dans le modèle CarburantMission
                                        $nom = $qui_a_remis
                                            ? $qui_a_remis->titre . ' ' . $qui_a_remis->prenom . ' ' . $qui_a_remis->nom
                                            : 'Utilisateur supprimé';
                                    @endphp
                                    <td>{{ $nom }}</td>
                                    <td>{{ $remise->observation }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- SECTION 3.1 : Tableau des remises carburant groupées --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Remises de carburant groupées par Date</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Montant remis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($remises_carburants_graphiques as $remise)
                                <tr>
                                    <td>{{ $remise->date_remise }}</td>
                                    <td>{{ number_format($remise->total_montant, 0, ',', ' ') }} FCFA</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            {{-- FIN SECTION 3 --}}

            <div class="alert alert-info">
                <strong>Total Carburant Remis:</strong>
                {{ number_format($remises_carburants->sum('montant_carburant_remis'), 0, ',', ' ') }} FCFA

            </div>
            <div class="alert alert-info">
                <strong>Total Kilométrage Parcouru:</strong>
                {{ number_format($remises_carburants->sum('kilometrage_depart'), 0, ',', ' ') }} Km
            </div>
            <div class="alert alert-info">
                <strong>Consommation Moyenne:</strong>
                @if ($remises_carburants->sum('kilometrage_depart') > 0)
                    {{ number_format(($remises_carburants->sum('montant_carburant_remis') / $remises_carburants->sum('kilometrage_depart')) * 100, 2, ',', ' ') }}
                    Litres/100Km
                @else
                    N/A
                @endif
            </div>
            {{-- FIN SECTION 2 --}}


            {{-- SECTION 4 : Graphique ChartJS --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Évolution de la consommation</h5>
                </div>
                <div class="card-body">
                    <canvas id="consoChart" height="100"></canvas>
                </div>
            </div>
        </div>

        {{-- SECTION 5 : Bouton Imprimer --}}
        <div class="text-end">
            <button onclick="printSection()" class="btn btn-outline-primary">
                <i class="bi bi-printer"></i> Imprimer
            </button>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Exemple données
        var ctx = document.getElementById('consoChart').getContext('2d');
        var consoChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!}, // ex: ["Jan", "Feb", "Mar"]
                datasets: [{
                    label: 'Consommation (Litres)',
                    data: {!! json_encode($data) !!}, // ex: [100, 120, 90]
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Fonction impression
        function printSection() {
            var printContents = document.getElementById('printableArea').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endpush
