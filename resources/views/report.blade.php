@extends('layout.app')

@section('content')
    <!-- Menu déroulant des garderies -->
    <div class="mb-4">
        @if ($nurseries->isNotEmpty())
            <form action="{{ route('report.show') }}" method="GET">
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

    <!-- Section du rapport -->
    @if ($selectedNursery)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $selectedNursery->name }}</h5>
                <hr>
                <p><strong>Total des revenus :</strong> {{ $totalPresences }} présences × 48 $ = {{ number_format($totalRevenu, 2) }} $</p>
                <p><strong>Total des dépenses :</strong> Dépenses admissibles : {{ number_format($depensesAdmissibles, 2) }} $ + Total des salaires : {{ number_format($totalSalaires, 2) }} $ = {{ number_format($totalDepenses, 2) }} $</p>
                <p><strong>Profit :</strong> Revenus ({{ number_format($totalRevenu, 2) }} $) - Dépenses ({{ number_format($totalDepenses, 2) }} $) = {{ number_format($profit, 2) }} $</p>
                <p><strong>Total des salaires :</strong> nombre de présence d'éducatrice * 8h * 18 $/heure</p>
            </div>
        </div>
    @else
        <p class="text-warning">Veuillez sélectionner une garderie pour voir le rapport.</p>
    @endif
@endsection