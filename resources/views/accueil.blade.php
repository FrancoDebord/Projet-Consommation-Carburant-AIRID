@extends('layouts.app')
@section('content')
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card card-kpi text-center p-3">
                <h5>Consommation totale</h5>
                <h3>12,540 L</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-kpi text-center p-3">
                <h5>Nombre de véhicules</h5>
                <h3>42</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-kpi text-center p-3">
                <h5>Missions effectuées</h5>
                <h3>125</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-kpi text-center p-3">
                <h5>Coût mensuel</h5>
                <h3>8,950 €</h3>
            </div>
        </div>
    </div>


    <div class="row mt-5">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Données récentes</div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Véhicule</th>
                                <th>Mission</th>
                                <th>Carburant (L)</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Renault Kangoo</td>
                                <td>Livraison</td>
                                <td>45</td>
                                <td>2025-09-01</td>
                            </tr>
                            <tr>
                                <td>Peugeot 208</td>
                                <td>Inspection</td>
                                <td>32</td>
                                <td>2025-09-02</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">Calendrier des missions</div>
                <div class="card-body" id="calendar"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();


            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [{
                        title: 'Mission 1',
                        start: '2025-09-10'
                    },
                    {
                        title: 'Mission 2',
                        start: '2025-09-15'
                    }
                ]
            });
            calendar.render();
        });
    </script>
@endpush
