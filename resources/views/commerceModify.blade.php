@extends('layout.app')

@section('content')
    <h3>Modifier un commerce</h3>
    <!-- Form to modify a commerce -->
    <form action="{{ route('commerce.update', $commerce->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="description" class="form-label">Nom :</label>
            <input type="text" name="description" id="description" class="form-control w-25"
                value="{{ $commerce->description }}" readonly>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Adresse :</label>
            <input type="text" name="address" id="address" class="form-control w-25" value="{{ $commerce->address }}"
                required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Téléphone :</label>
            <input type="text" name="phone" id="phone" class="form-control w-25" value="{{ $commerce->phone }}" required>
        </div>

        <button type="submit" class="btn btn-success">Modifier</button>
        <a href="{{ route('commerce.show', ['commerce_id' => $commerce->id]) }}" class="btn btn-warning">Annuler</a>
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
            @forelse($nursery as $nurseries)
                @forelse ($nurseries->expenses as $expense)
                    @if ($expense->commerce_id == $commerce->id)
                        <tr>
                            <td>{{ $nurseries->name ?? 'Non défini' }}</td>
                            <td>{{ $expense->dateTime }}</td>
                            <td>{{ number_format($expense->amount, 2) }}$</td>
                            <td>{{ number_format($expense->amount * ($expense->expenseCategory?->pourcentage ?? 0), 2) }}$</td>
                            <td>{{ $expense->expenseCategory?->description ?? 'Non défini' }}</td>
                            <td>{{ $expense->commerce?->description ?? 'Non défini' }}</td>
                        </tr>
                    @endif
                @empty
                    <!-- No expenses for this nursery, but we don't need to display anything here -->
                @endforelse
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucune dépense trouvée pour ce commerce.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection