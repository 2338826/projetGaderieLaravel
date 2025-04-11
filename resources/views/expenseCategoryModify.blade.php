@extends('layout.app')

@section('content')
    <h3>Modifier une catégorie de dépense</h3>
    <!-- Form to modify an expense category -->
    <form action="{{ route('expenseCategory.update', $expenseCategory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="description" class="form-label">Nom :</label>
            <input type="text" name="description" id="description" class="form-control w-25"
                value="{{ $expenseCategory->description }}" required>
        </div>

        <div class="mb-3">
            <label for="pourcentage" class="form-label">Pourcentage :</label>
            <input type="number" name="pourcentage" id="pourcentage" class="form-control w-25" step="0.01" min="0" max="1"
                value="{{ $expenseCategory->pourcentage }}" required>
        </div>

        <button type="submit" class="btn btn-success">Modifier</button>
        <a href="{{ route('expenseCategory.show') }}" class="btn btn-warning">Annuler</a>
    </form>

    <h3 class="mt-4">Liste des dépenses</h3>
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Garderie</th>
                <th>DateTemps</th>
                <th>Montant</th>
                <th>Montant admissible</th>
                <th>Catégorie de dépense</th>
                <th>Commerce</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($expenseCategory->expenses as $expense)
                <tr>
                    <td>{{ $expense->nursery?->name ?? 'Non défini' }}</td>
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
@endsection