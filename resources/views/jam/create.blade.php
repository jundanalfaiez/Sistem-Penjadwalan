<!-- resources/views/jam/create.blade.php -->

@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambahkan Jam Baru</h1>

    <!-- Form untuk membuat Jam baru -->
    <form action="{{ route('jam.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="kode_jam">Kode Jam:</label>
            <input type="text" class="form-control" id="kode_jam" name="kode_jam" required>
        </div>
        <div class="form-group">
            <label for="jamnya">Jam:</label>
            <input type="text" class="form-control" id="jamnya" name="jamnya" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('jam.index') }}" class="btn btn-default">Back to list</a>
    </form>
 @endsection

@push('notif')
@if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success border-left-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@endpush

