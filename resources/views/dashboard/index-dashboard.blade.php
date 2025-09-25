@extends('layouts.app')
@section('content')
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">Consommation par véhicule</div>
                <div class="card-body">
                    <canvas id="chartVehicules"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">Consommation mensuelle</div>
                <div class="card-body">
                    <canvas id="chartMois"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxVehicules = document.getElementById('chartVehicules');
        new Chart(ctxVehicules, {
            type: 'bar',
            data: {
                labels: ['Kangoo', '208', 'Clio'],
                datasets: [{
                    label: 'Litres',
                    data: [120, 90, 60],
                    backgroundColor: '#007bff'
                }]
            },
        });


        const ctxMois = document.getElementById('chartMois');
        new Chart(ctxMois, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar'],
                datasets: [{
                    label: 'Litres',
                    data: [300, 250, 400],
                    borderColor: '#ffc107',
                    fill: false
                }]
            },
        });
    </script>
@endpush
