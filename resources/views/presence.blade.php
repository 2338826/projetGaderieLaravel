@extends('layout.app')
@section('content')
<div class="mb-4">
        @if ($nurseries->isNotEmpty())
            <form action="{{ route('expense.show') }}" method="GET">
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
                <th>Prenom Enfant</th>
                <th>Date de naissance enfant</th>
                <th>Nom educateur</th>
                <th>Prenom educateur</th>
                <th>Date de naissance educateur</th>
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
            @forelse ($presences->children as $child)
                <tr>
                    <td>{{ $presence->date }}</td>
                    
                    <td>{{ $child->name }}</td>
                    <td>{{ $expense->commerce?->description ?? 'Non défini' }}</td>
                    <td>
                       
                        <form action="{{ route('expense.destroy', $expense->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucune dépense trouvée pour cette garderie.</td>
                </tr>
                @endforelse
                @empty
                <tr>
                    <td colspan="6" class="text-center">Aucune dépense trouvée pour cette garderie.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection