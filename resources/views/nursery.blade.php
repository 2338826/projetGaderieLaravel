@extends('layouts.app')

@section('content')
    <h1>Nursery List</h1>
    <a href="{{ route('nursery.add') }}" class="btn btn-primary">Add Nursery</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Phone</th>
                <th>State</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nurseries as $nursery)
                <tr>
                    <td>{{ $nursery->name }}</td>
                    <td>{{ $nursery->address }}</td>
                    <td>{{ $nursery->city }}</td>
                    <td>{{ $nursery->phone }}</td>
                    <td>{{ $nursery->state->description }}</td>
                    <td>
                        <a href="{{ route('nursery.edit', $nursery->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('nursery.destroy', $nursery->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('nursery.clear') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Clear All Nurseries</button>
    </form>
    <form action="{{ route('nursery.add') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="address">Adresse :</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}" required>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="city">Ville :</label>
            <input type="text" name="city" id="city" value="{{ old('city') }}" required>
            @error('city')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="id_state">Province :</label>
            <select name="id_state" id="id_state" required>
                @foreach($states as $state)
                    <option value="{{ $state->id }}" {{ old('id_state') == $state->id ? 'selected' : '' }}>
                        {{ $state->description }}
                    </option>
                @endforeach
            </select>
            @error('id_state')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Téléphone :</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-create">Créer</button>
    </form>
@endsection