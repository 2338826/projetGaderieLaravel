@extends('layout.app')

@section('content')
   <!-- Drop-down list of daycares -->
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

    <!-- Expenses Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>DateTemps</th>
                <th>Montant</th>
                <th>Montant admissible</th>
                <th>Catégorie de dépense</th>
                <th>Commerce</th>
                <th>
                @if ($selectedNursery)
        <form action="{{ route('expense.clear', 0) }}" method="POST" class="mb-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Vider la liste</button>
        </form>
    @endif
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($expenses as $expense)
                <tr>
                    <td>{{ $expense->dateTime }}</td>
                    <td>{{ number_format($expense->amount, 2) }}$</td>
                    <td>{{ number_format($expense->amount * ($expense->expenseCategory?->pourcentage ?? 0), 2) }}$</td>
                    <td>{{ $expense->expenseCategory?->description ?? 'Non défini' }}</td>
                    <td>{{ $expense->commerce?->description ?? 'Non défini' }}</td>
                    <td>
                        <a href="{{ route('expense.edit', $expense->id) }}" class="btn btn-warning btn-sm">Modifier</a>
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
        </tbody>
    </table>

  <!-- Form to add an expense -->
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
    <label class="form-label">Commerce :</label>
    <div class="d-flex flex-column">
        @foreach ($commerces as $commerce)
            <div class="form-check">
                <input type="radio" 
                       name="commerce_id" 
                       id="commerce_{{ $commerce->id }}" 
                       value="{{ $commerce->id }}" 
                       class="form-check-input"
                       @if ($loop->first) required @endif>
                <label for="commerce_{{ $commerce->id }}" class="form-check-label">
                    {{ $commerce->description }}
                </label>
            </div>
        @endforeach
    </div>
</div>

            <input type="hidden" name="nursery_id" value="{{ $selectedNursery->id }}">

            <button type="submit" class="btn btn-success">Créer</button>
        </form>
    @else
        <p class="text-danger">Veuillez sélectionner une garderie pour ajouter une dépense.</p>
    @endif
@endsection