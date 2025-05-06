@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Tambah Hari Baru') }}</h1>

    <form action="{{ route('hari.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="kode_hari">Kode Hari</label>
            <input type="text" name="kode_hari" id="kode_hari" class="form-control @error('kode_hari') is-invalid @enderror" value="{{ old('kode_hari') }}" required>
            @error('kode_hari')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="hari">Nama Hari</label>
            <input type="text" name="hari" id="hari" class="form-control @error('hari') is-invalid @enderror" value="{{ old('hari') }}" required>
            @error('hari')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('hari.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

@endsection
