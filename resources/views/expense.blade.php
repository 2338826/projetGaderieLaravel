@extends('layout.app')

@section('content')
    <!-- Liste déroulante des garderies -->
    <div class="mb-4">
        @if ($nurseries->isNotEmpty())
            <form action="{{ route('expense.show') }}" method="GET">
                <label for="nursery_id" class="form-label">Sélectionner une garderie :</label>
                <select name="nursery_id" id="nursery_id" class="form-select w-25" onchange="this.form.submit()">
                    @foreach ($nurseries as $nursery)
                        <option value="{{ $nursery->id }}" {{ $selectedNursery && $selectedNursery->id == $nursery->id ? 'selected' : '' }}>
                            {{ $nursery->name }} <!-- Utiliser 'name' au lieu de 'description' -->
                        </option>
                    @endforeach
                </select>
            </form>
        @else
            <p class="text-danger">Aucune garderie disponible. Veuillez en ajouter une d'abord.</p>
        @endif
    </div>

    <!-- Tableau des dépenses -->
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>DateTemps</th>
                <th>Montant</th>
                <th>Montant admissible</th>
                <th>Catégorie de dépense</th>
                <th>Commerce</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($expenses as $expense)
                <tr>
                    <td>{{ $expense->dateTime }}</td>
                    <td>{{ number_format($expense->amount, 2) }}$</td>
                    <td>{{ number_format($expense->amount * ($expense->categoryExpense?->pourcentage ?? 0), 2) }}$</td>
                    <td>{{ $expense->categoryExpense?->description ?? 'Non défini' }}</td>
                    <td>{{ $expense->commerce?->description ?? 'Non défini' }}</td>
                    <td>
                        <form action="{{ route('expense.destroy', $expense->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                        <a href="{{ route('expense.edit', $expense->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucune dépense trouvée pour cette garderie.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Bouton pour vider la liste -->
    @if ($selectedNursery)
        <form action="{{ route('expense.clear', 0) }}" method="POST" class="mb-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Vider la liste</button>
        </form>
    @endif

    <!-- Formulaire pour ajouter une dépense -->
    <h3>Ajouter une dépense</h3>
    @if ($selectedNursery)
        <form action="{{ route('expense.add') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="amount" class="form-label">Montant :</label>
                <input type="number" step="0.01" name="amount" id="amount" class="form-control w-25" required>
            </div>

            <div class="mb-3">
                <label for="category_expense_id" class="form-label">Catégorie de dépense :</label>
                <select name="category_expense_id" id="category_expense_id" class="form-select w-25" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="commerce_id" class="form-label">Commerce :</label>
                <select name="commerce_id" id="commerce_id" class="form-select w-25" required>
                    @foreach ($commerces as $commerce)
                        <option value="{{ $commerce->id }}">{{ $commerce->description }}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="nursery_id" value="{{ $selectedNursery->id }}">

            <button type="submit" class="btn btn-success">Créer</button>
        </form>
    @else
        <p class="text-danger">Veuillez sélectionner une garderie pour ajouter une dépense.</p>
    @endif
@endsection