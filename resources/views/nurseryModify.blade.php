@extends('layouts.app')

@section('title', 'Modifier une Garderie')

@section('content')
    <h1>Modifier une Garderie</h1>
    <form action="{{ route('nursery.update', $nursery->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" value="{{ old('name', $nursery->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="address">Adresse :</label>
            <input type="text" name="address" id="address" value="{{ old('address', $nursery->address) }}" required>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="city">Ville :</label>
            <input type="text" name="city" id="city" value="{{ old('city', $nursery->city) }}" required>
            @error('city')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="id_state">Province :</label>
            <select name="id_state" id="id_state" required>
                @foreach($states as $state)
                    <option value="{{ $state->id }}" {{ old('id_state', $nursery->id_state) == $state->id ? 'selected' : '' }}>
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
            <input type="text" name="phone" id="phone" value="{{ old('phone', $nursery->phone) }}" required>
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-create">Modifier</button>
    </form>
@endsection