@extends('layout.app')

@section('content')
<div class="mb-4">
    @if ($nurseries->isNotEmpty())
        <form action="{{ route('presence.show') }}" method="GET">
            <label for="nursery_id" class="form-label">Sélectionner une garderie :</label>
            <select name="nursery_id" id="nursery_id" class="form-select w-25" onchange="this.form.submit()">
                @foreach ($nurseries as $nursery)
                    <option value="{{ $nursery->id }}" {{ $selectedNursery && $selectedNursery->id == $nursery->id ? 'selected' : '' }}>
                        {{ $nursery->name }}
                    </option>
                @endforeach
            </select>
        </form>
    @else
        <p class="text-danger">Aucune garderie disponible. Veuillez en ajouter une d'abord.</p>
    @endif
</div>

<!-- Presences Table -->
<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>Date</th>
            <th>Nom Enfant</th>
            <th>Prénom Enfant</th>
            <th>Date de naissance enfant</th>
            <th>Nom éducateur</th>
            <th>Prénom éducateur</th>
            <th>Date de naissance éducateur</th>
            <th>
                @if ($selectedNursery)
                    <form action="{{ route('presence.clear', 0) }}" method="POST" class="mb-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Vider la liste</button>
                    </form>
                @endif
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($presences as $presence)
            <tr>
                <td>{{ $presence->date }}</td>
                <td>{{ $presence->child->name ?? 'Non défini' }}</td>
                <td>{{ $presence->child->firstName ?? 'Non défini' }}</td>
                <td>{{ $presence->child->birth_date ?? 'Non défini' }}</td>
                <td>{{ $presence->educator->name ?? 'Non défini' }}</td>
                <td>{{ $presence->educator->firstName ?? 'Non défini' }}</td>
                <td>{{ $presence->educator->birth_date ?? 'Non défini' }}</td>
                <td>
                    <form action="{{ route('presence.destroy', $presence->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Aucune présence trouvée pour cette garderie.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<form action="{{ route('presence.add') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="date" class="form-label">Date :</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="child_id" class="form-label">Enfant :</label>
                <select name="child_id" id="child_id" class="form-select" required>
                    @foreach ($children as $child)
                        <option value="{{ $child->id }}">{{ $child->name }} {{ $child->firstName }} [{{ $child->birth_date }}]</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="educator_id" class="form-label">Éducateur :</label>
                <select name="educator_id" id="educator_id" class="form-select" required>
                    @foreach ($educators as $educator)
                        <option value="{{ $educator->id }}">{{ $educator->name }} {{ $educator->firstName }} [{{ $educator->birth_date }}]</option>
                    @endforeach
                </select>
            </div>
        </div>
        <input type="hidden" name="nursery_id" value="{{ $selectedNursery->id }}">
        <button type="submit" class="btn btn-success">Créer</button>
    </form>
@endsection