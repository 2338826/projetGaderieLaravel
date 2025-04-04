@extends('layout.app')

@section('content')
    <h3>Modifier une dépense</h3>

    <!-- Formulaire pour modifier une dépense -->
    <form action="{{ route('expense.update', $expense->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Champ Date et Heure -->
        <div class="mb-3">
            <label for="dateTime" class="form-label">Date et Heure :</label>
            <input type="datetime-local" 
                   name="dateTime" 
                   id="dateTime" 
                   class="form-control w-25" 
                   value="{{ $expense->dateTime}}" 
                   readonly>
        </div>

        <!-- Champ Montant -->
        <div class="mb-3">
            <label for="amount" class="form-label">Montant :</label>
            <input type="number" 
                   step="0.01" 
                   name="amount" 
                   id="amount" 
                   class="form-control w-25" 
                   value="{{ $expense->amount }}" 
                   required>
        </div>

        <!-- Champ Catégorie de dépense -->
        <div class="mb-3">
            <label for="category_expense_id" class="form-label">Catégorie de dépense :</label>
            <select name="category_expense_id" id="category_expense_id" class="form-select w-25" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                            {{ $expense->category_expense_id == $category->id ? 'selected' : '' }}>
                        {{ $category->description }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Champ Commerce (boutons radio) -->
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
                               {{ $expense->commerce_id == $commerce->id ? 'checked' : '' }}
                               @if ($loop->first) required
                                @endif>
                        <label for="commerce_{{ $commerce->id }}" class="form-check-label">
                            {{ $commerce->description }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Champ caché pour nursery_id -->
        <input type="hidden" name="nursery_id" value="{{ $expense->nursery_id }}">

        <!-- Boutons -->
        <button type="submit" class="btn btn-success">Modifier</button>
        <a href="{{ route('expense.show', ['nursery_id' => $expense->nursery_id]) }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection