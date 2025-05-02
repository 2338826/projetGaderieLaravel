@extends('layout.app')

@section('title', 'Modifier un enfant')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Modifier un enfant</h1>



        <!-- Modification form -->
        <form action="{{ route('child.update', $child->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nom :</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $child->name) }}"
                        readonly>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="firstName" class="form-label">Prenom</P> :</label>
                    <input type="text" name="firstName" id="firstName" class="form-control"
                        value="{{ old('firstName', $child->firstName) }}" readonly>
                    @error('firstName')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="birth_date" class="form-label">Date de naissance :</label>
                    <input type="text" name="birth_date" id="birth_date" class="form-control"
                        value="{{ old('birth_date', $child->birth_date) }}" readonly>
                    @error('birth_date')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="address" class="form-label">Adresse :</label>
                    <input type="text" name="address" id="address" class="form-control"
                        value="{{ old('address', $child->address) }}" required>
                    @error('address')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="city" class="form-label">Ville :</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $child->city) }}"
                        required>
                    @error('city')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="id_state" class="form-label">Province :</label>
                    <select name="id_state" id="id_state" class="form-select" required>
                        <option value="">Sélectionner une province ou un territoire</option>
                        @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ old('id_state', $child->id_state) == $state->id ? 'selected' :
                            '' }}>
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
                    <input type="text" name="phone" id="phone" class="form-control"
                        value="{{ old('phone', $child->phone) }}" required>
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
        <h3 class="mt-4">Liste des presences</h3>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Garderie</th>
                    <th>Date</th>
                    <th>Nom enfant</th>
                    <th>Prénom enfant</th>
                    <th>Date naissance enfant</th>
                    <th>Nom éducateur</th>
                    <th>Prénom éducateur</th>
                    <th>Date naissance éducateur</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($presences as $presence)
                    <tr>
                        <td>{{ $presence->nursery?->name ?? 'Non défini' }}</td>
                        <td>{{ $presence->date }}</td>
                        <td>{{ $presence->child?->name ?? 'Non défini' }}</td>
                        <td>{{ $presence->child?->firstName ?? 'Non défini' }}</td>
                        <td>{{ $presence->child?->birth_date ?? 'Non défini' }}</td>
                        <td>{{ $presence->educator?->name ?? 'Non défini' }}</td>
                        <td>{{ $presence->educator?->firstName ?? 'Non défini' }}</td>
                        <td>{{ $presence->educator?->birth_date ?? 'Non défini' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Aucune présence trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection