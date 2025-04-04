
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $nursery->name }}</td>
                        <td>{{ $nursery->address }}</td>
                        <td>{{ $nursery->city }}</td>
                        <td>{{ $nursery->state->description ?? 'N/A' }}</td>
                        <td>{{ $nursery->phone }}</td>
                        <td>
                            <a href="{{ route('nursery.show') }}" class="btn btn-danger btn-sm">Vider la liste</a>
                        </td>
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
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $nursery->name) }}" required>
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
    </div>
@endsection

