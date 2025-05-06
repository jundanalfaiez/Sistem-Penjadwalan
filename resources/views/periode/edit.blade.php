@extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Edit Tahun Ajaran') }}</h1>

    <!-- Main Content goes here -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('periode.update', $periode->id) }}" method="post">
                @csrf
                @method('PUT')

                <!-- Tahun Ajaran -->
                <div class="form-group">
                    <label for="name">Tahun Ajaran</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Masukkan Tahun Ajaran" autocomplete="off" value="{{ old('name', $periode->name) }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('periode.index') }}" class="btn btn-default">Kembali ke daftar</a>
            </form>
        </div>
    </div>
    <!-- End of Main Content -->
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
