@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Liste des véhicules</h3>
        <a href="{{ route('vehicules.create') }}" class="btn btn-primary">+ Ajouter un véhicule</a>
    </div>


    <table id="vehiculesTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Immatriculation</th>
                <th>Marque</th>
                <th>Nom</th>
                <th>Type carburant</th>
                <th>Kilométrage</th>
                <th>Conso (L/100km)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicules as $vehicule)
                <tr>
                    <td>{{ $vehicule->id }}</td>
                    <td>{{ $vehicule->immatriculation }}</td>
                    <td>{{ $vehicule->marque }}</td>
                    <td>{{ $vehicule->nom }}</td>
                    <td>{{ $vehicule->type_carburant }}</td>
                    <td>{{ $vehicule->kilometrage_actuel }}</td>
                    <td>{{ $vehicule->conso_moyenne }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="mt-5">
        <canvas id="vehiculesChart"></canvas>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#vehiculesTable').DataTable();
            });


            const ctx = document.getElementById('vehiculesChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($vehicules->pluck('nom')),
                    datasets: [{
                        label: 'Consommation (L/100km)',
                        data: @json($vehicules->pluck('conso_moyenne')),
                        backgroundColor: 'rgba(54, 162, 235, 0.7)'
                    }]
                }
            });
        </script>
    @endpush
@endsection
