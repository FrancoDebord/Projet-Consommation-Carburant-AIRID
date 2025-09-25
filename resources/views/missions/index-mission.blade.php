@extends('layouts.app')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">Gestion des missions</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Véhicule</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Livraison A</td>
                        <td>Kangoo</td>
                        <td>2025-09-10</td>
                        <td>2025-09-11</td>
                        <td><button class="btn btn-sm btn-warning">Modifier</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
