@extends('layout.app')

@section('title', 'Garderies')

@section('content')
    <!-- Tableaux des crèches -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Province</th>
                <th>Téléphone</th>
                <th></th> <!-- Colonne pour les actions -->
            </tr>
        </thead>
        <tbody>
            @forelse($nurseries as $nursery)
                <tr>
                    <td>{{ $nursery->name }}</td>
                    <td>{{ $nursery->address }}</td>
                    <td>{{ $nursery->city }}</td>
                    <td>{{ $nursery->province }}</td>
                    <td>{{ $nursery->phone }}</td>
                    <td>
                        <a href="{{ route('nursery.edit', $nursery->id) }}" class="btn btn-warning btn-sm me-1">Modifier</a>
                        <form action="{{ route('nursery.destroy', $nursery->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucune crèche trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Bouton "Vider la liste" -->
    <form action="{{ route('nursery.clear') }}" method="POST" class="mb-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Vider la liste</button>
    </form>

    <!-- Formulaire pour ajouter une crèche -->
    <form action="{{ route('nursery.add') }}" method="POST" class="mt-4">
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
                <label for="province" class="form-label">Province :</label>
                <select name="province" id="province" class="form-select custom-input" required>
                    <option value="">Sélectionner une province ou un territoire</option>
                    <option value="Alberta" {{ old('province') == 'Alberta' ? 'selected' : '' }}>Alberta</option>
                    <option value="Colombie-Britannique" {{ old('province') == 'Colombie-Britannique' ? 'selected' : '' }}>
                        Colombie-Britannique</option>
                    <option value="Manitoba" {{ old('province') == 'Manitoba' ? 'selected' : '' }}>Manitoba</option>
                    <option value="Nouveau-Brunswick" {{ old('province') == 'Nouveau-Brunswick' ? 'selected' : '' }}>
                        Nouveau-Brunswick</option>
                    <option value="Terre-Neuve-et-Labrador" {{ old('province') == 'Terre-Neuve-et-Labrador' ? 'selected' : '' }}>Terre-Neuve-et-Labrador</option>
                    <option value="Nouvelle-Écosse" {{ old('province') == 'Nouvelle-Écosse' ? 'selected' : '' }}>
                        Nouvelle-Écosse</option>
                    <option value="Ontario" {{ old('province') == 'Ontario' ? 'selected' : '' }}>Ontario</option>
                    <option value="Île-du-Prince-Édouard" {{ old('province') == 'Île-du-Prince-Édouard' ? 'selected' : '' }}>
                        Île-du-Prince-Édouard</option>
                    <option value="Québec" {{ old('province') == 'Québec' ? 'selected' : '' }}>Québec</option>
                    <option value="Saskatchewan" {{ old('province') == 'Saskatchewan' ? 'selected' : '' }}>Saskatchewan
                    </option>
                    <option value="Territoires du Nord-Ouest" {{ old('province') == 'Territoires du Nord-Ouest' ? 'selected' : '' }}>Territoires du Nord-Ouest</option>
                    <option value="Nunavut" {{ old('province') == 'Nunavut' ? 'selected' : '' }}>Nunavut</option>
                    <option value="Yukon" {{ old('province') == 'Yukon' ? 'selected' : '' }}>Yukon</option>
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