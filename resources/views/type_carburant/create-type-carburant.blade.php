@extends('layouts.app')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">Ajouter un type de carburant</div>
        <div class="card-body">
            <form method="POST" action="{{ route('typecarburants.store') }}"> @csrf
                <div class="mb-3"><input type="text" name="nom" class="form-control" placeholder="Nom du type" required>
                </div>
                <div class="mb-3"><input type="number" step="0.01" name="prix_station" class="form-control"
                        placeholder="Prix station" required></div>
                <button class="btn btn-success">Ajouter</button>
            </form>
        </div>
    </div>
@endsection
