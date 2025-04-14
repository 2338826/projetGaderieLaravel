@extends('layout.app')

@section('title', 'Enfants')

@section('content')

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Date de Naissance</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Province</th>
                <th>Téléphone</th>
                <th>
                    <!-- "Empty List" Button -->
                    <form action="{{ route('child.clear', 0) }}" method="POST" class="mb-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Vider la liste</button>
                    </form>
                </th>
                <!-- Column for actions -->
            </tr>
        </thead>
        <tbody>
            @forelse($children as $child)
                <tr>
                    <td>{{ $child->name }}</td>
                    <td>{{ $child->firstName }}</td>
                    <td>{{ $child->birth_date }}</td>
                    <td>{{ $child->address }}</td>
                    <td>{{ $child->city }}</td>
                    <td>{{ $child->state->description }}</td>
                    <td>{{ $child->phone }}</td>

                    <td>
                        <a href="{{ route('child.edit', ['id' => $child->id]) }}"
                            class="btn btn-warning btn-sm me-1">Modifier</a>
                        <form action="{{ route('child.destroy', $child->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucun enfant trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>



    <!-- Form to add a daycare -->
    <form action="{{ route('child.add') }}" method="POST" class="mt-4">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Nom :</label>
                <input type="text" name="name" id="name" class="form-control custom-input" value="{{ old('name') }}"
                    required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="firstName" class="form-label">Prenom :</label>
                    <input type="text" name="firstName" id="firsName" class="form-control custom-input"
                        value="{{ old('firstName') }}" required>
                    @error('firstName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="birth_date" class="form-label">Date de naissance :</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control custom-input"
                        value="{{ old('birth_date') }}" required>
                    @error('birth_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="address" class="form-label">Adresse :</label>
                    <input type="text" name="address" id="address" class="form-control custom-input"
                        value="{{ old('address') }}" required>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="city" class="form-label">Ville :</label>
                    <input type="text" name="city" id="city" class="form-control custom-input" value="{{ old('city') }}"
                        required>
                    @error('city')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="state" class="form-label">Province :</label>
                    <select name="id_state" id="id_state" class="form-select custom-input" required>
                        <option value="">Sélectionner une province ou un territoire</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}" {{ old('province') == $state->id ? 'selected' : '' }}>
                                {{ $state->description }}
                            </option>
                        @endforeach
                    </select>
                    @error('province')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="phone" class="form-label">Téléphone :</label>
                    <input type="text" name="phone" id="phone" class="form-control custom-input" value="{{ old('phone') }}"
                        required>
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Créer</button>
                </div>
            </div>
    </form>
@endsection