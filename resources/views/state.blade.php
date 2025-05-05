@extends('layout.app')

@section('title', 'States')

@section('content')
    <h1>Liste des États</h1>
    <table class="table table-striped mt-4">
        <thead class="table-light">
            <tr>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($states as $state)
                <tr>
                    <td>{{ $state->description }}</td>
                    <td>
                        <form action="{{ route('state.destroy', $state->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Aucun état trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
        <!-- Form to add a state -->
        <form action="{{ route('state.add') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" id="description" class="form-control" required placeholder="Description de l'état">
            </div>
    
            <button type="submit" class="btn btn-primary">Ajouter un État</button>
        </form>
@endsection