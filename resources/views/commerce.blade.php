@extends('layout.app')
@section('content')
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Description</th>
                <th>Adresse</th>
                <th>Telephone</th>
                <th>
                    <form action="{{ route('commerce.clear', 0) }}" method="POST" class="mb-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Vider la liste</button>
                    </form>

                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($commerces as $commerce)
                <tr>
                    <td>{{ $commerce->description }}</td>
                    <td>{{ $commerce->address }}</td>
                    <td>{{ $commerce->phone }}</td>
                    <td>
                        <a href="{{ route('commerce.edit', $commerce->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('commerce.destroy', $commerce->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucun commerce .</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    <h3>Ajouter un commerce</h3>

    <form action="{{ route('commerce.add') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="description" class="form-label">Description :</label>
            <input type="text" name="description" id="description" class="form-control w-25" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Adresse:</label>
            <input type="text" name="address" id="address" class="form-control w-25" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telephone:</label>
            <input type="text" name="phone" id="phone" class="form-control w-25" required>
        </div>




        <button type="submit" class="btn btn-success">Créer</button>
    </form>
@endsection