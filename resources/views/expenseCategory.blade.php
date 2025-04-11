@extends('layout.app')

@section('content')
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Description</th>
                <th>Pourcentage</th>
                <th>
                    <form action="{{ route('expenseCategory.clear', 0) }}" method="POST" class="mb-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Vider la liste</button>
                    </form>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($expenseCategories as $expenseCategory)
                <tr>
                    <td>{{ $expenseCategory->description }}</td>
                    <td>{{ $expenseCategory->pourcentage }}</td>
                    <td>
                        <a href="{{ route('expenseCategory.edit', $expenseCategory->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('expenseCategory.destroy', $expenseCategory->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Aucune catégorie de dépense trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <form action="{{ route('expenseCategory.add') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="description" class="form-label">Description :</label>
            <input type="text" name="description" id="description" class="form-control w-25" required>
        </div>

        <div class="mb-3">
            <label for="pourcentage" class="form-label">Pourcentage :</label>
            <input type="number" name="pourcentage" id="pourcentage" class="form-control w-25" step="0.01" min="0" max="1"
                required>
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
    </form>
@endsection