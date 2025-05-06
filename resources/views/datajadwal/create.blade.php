@extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Tambah Data Matakuliah') }}</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('data-matakuliah.store') }}" method="POST">
                @csrf

                <!-- Dropdown for Mata Kuliah -->
                <div class="form-group">
                    <label for="matakuliah_id">Mata Kuliah</label>
                    <select name="matakuliah_id" id="matakuliah_id" class="form-control @error('matakuliah_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih Mata Kuliah</option>
                        @foreach ($matakuliahList as $matakuliah)
                            <option value="{{ $matakuliah->id }}" 
                                {{ old('matakuliah_id') == $matakuliah->id ? 'selected' : '' }}>
                                {{ $matakuliah->nama_matakuliah }}
                            </option>
                        @endforeach
                    </select>
                    @error('matakuliah_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Dropdown for Dosen -->
                <div class="form-group">
                    <label for="dosen_id">Dosen</label>
                    <select name="dosen_id" id="dosen_id" class="form-control @error('dosen_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih Dosen</option>
                        @foreach ($dosenList as $dosen)
                            <option value="{{ $dosen->id }}" 
                                {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                {{ $dosen->nama_dosen }}
                            </option>
                        @endforeach
                    </select>
                    @error('dosen_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Jumlah Mahasiswa -->
                <div class="form-group">
                    <label for="jumlah_mahasiswa">Jumlah Mahasiswa</label>
                    <input type="number" name="jumlah_mahasiswa" id="jumlah_mahasiswa" class="form-control @error('jumlah_mahasiswa') is-invalid @enderror" value="{{ old('jumlah_mahasiswa') }}" required>
                    @error('jumlah_mahasiswa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Dropdown for Periode -->
                <div class="form-group">
                    <label for="periode_id">Periode</label>
                    <select name="periode_id" id="periode_id" class="form-control @error('periode_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih Periode</option>
                        @foreach ($periodeList as $periode)
                            <option value="{{ $periode->id }}" 
                                {{ old('periode_id') == $periode->id ? 'selected' : '' }}>
                                {{ $periode->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('periode_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('data-matakuliah.index') }}" class="btn btn-default">Kembali ke daftar</a>
            </form>
        </div>
    </div>
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
