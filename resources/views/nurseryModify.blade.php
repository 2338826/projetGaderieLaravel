
@extends('layout.app')

@section('title', 'Modifier une Garderie')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Modifier une Garderie</h1>

       <!-- Table showing current data -->
        <div class="table-responsive mb-4">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                        <th>Province</th>
                        <th>Téléphone</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $nursery->name }}</td>
                        <td>{{ $nursery->address }}</td>
                        <td>{{ $nursery->city }}</td>
                        <td>{{ $nursery->state->description ?? 'N/A' }}</td>
                        <td>{{ $nursery->phone }}</td>
                        
                    </tr>
                </tbody>
            </table>
        </div>

       <!-- Modification form -->
        <form action="{{ route('nursery.update', $nursery->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nom :</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $nursery->name) }}" readonly>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="address" class="form-label">Adresse :</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $nursery->address) }}" required>
                    @error('address')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="city" class="form-label">Ville :</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $nursery->city) }}" required>
                    @error('city')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6" >
                    <label for="id_state" class="form-label">Province :</label>
                    <select name="id_state" id="id_state" class="form-select" required>
                        <option value="">Sélectionner une province ou un territoire</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}" {{ old('id_state', $nursery->id_state) == $state->id ? 'selected' : '' }}>
                                {{ $state->description }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_state')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="phone" class="form-label">Téléphone :</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $nursery->phone) }}" required>
                    @error('phone')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-warning">Modifier</button>
                </div>
            </div>
        </form>
        <h3 class="mt-4">Liste des dépenses</h3>
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
               
                <th>DateTemps</th>
                <th>Montant</th>
                <th>Montant admissible</th>
                <th>Catégorie de dépense</th>
                <th>Commerce</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($nursery->expenses as $expense)
                <tr>
                    <td>{{ $expense->dateTime }}</td>
                    <td>{{ number_format($expense->amount, 2) }}$</td>
                    <td>{{ number_format($expense->amount * ($expense->expenseCategory?->pourcentage ?? 0), 2) }}$</td>
                    <td>{{ $expense->expenseCategory?->description ?? 'Non défini' }}</td>
                    <td>{{ $expense->commerce?->description ?? 'Non défini' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucune dépense trouvée pour cette catégorie.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
@endsection

