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
    </div>
@endsection