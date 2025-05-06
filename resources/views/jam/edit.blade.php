<!-- resources/views/jam/edit.blade.php -->

@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Jam</h1>

    <!-- Form for editing Jam -->
    <form action="{{ route('jam.update', $jam->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Use the PUT method for updates --}}
        <div class="form-group">
            <label for="kode_jam">Kode Jam:</label>
            <input type="text" class="form-control" id="kode_jam" name="kode_jam" value="{{ $jam->kode_jam }}" required>
        </div>
        <div class="form-group">
            <label for="jamnya">Jam:</label>
            <input type="text" class="form-control" id="jamnya" name="jamnya" value="{{ $jam->jamnya }}" required>
        </div>
        {{-- Add other fields as needed --}}
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('jam.index') }}" class="btn btn-default">Back to list</a>
    </form>

    <!-- Display validation errors, if any -->
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Display success message, if any -->
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
@endsection
