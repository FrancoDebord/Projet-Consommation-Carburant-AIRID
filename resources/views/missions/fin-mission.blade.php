@extends('layouts.app')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">Clôturer une mission</div>
        <div class="card-body">
            <form method="POST" action="{{ route('pointsfin.store') }}" enctype="multipart/form-data"> @csrf
                <div class="mb-3"><input type="date" name="date_retour" class="form-control" required></div>
                <div class="mb-3"><input type="number" name="kilometrage_arrivee" class="form-control"
                        placeholder="Kilométrage arrivée" required></div>
                <div class="mb-3"><input type="file" name="image_kilometrage_arrive" class="form-control"></div>
                <div class="mb-3"><input type="number" step="0.01" name="montant_restant" class="form-control"
                        placeholder="Montant restant"></div>
                <div class="mb-3">
                    <select name="mission_id" class="form-control">
                        @foreach ($missions as $mission)
                            <option value="{{ $mission->id }}">{{ $mission->objet }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success">Clôturer</button>
            </form>
        </div>
    </div>
@endsection
