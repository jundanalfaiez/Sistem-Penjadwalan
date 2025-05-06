@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Tambah Jadwal Baru') }}</h1>

    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf

        <!-- Matakuliah Dropdown -->
        <div class="form-group">
            <label for="matakuliah_id">Matakuliah</label>
            <select name="matakuliah_id" id="matakuliah_id" class="form-control @error('matakuliah_id') is-invalid @enderror">
                <option value="" disabled selected>Pilih Matakuliah</option>
                @foreach($matakuliahs as $matakuliah)
                    <option value="{{ $matakuliah->id }}" {{ old('matakuliah_id') == $matakuliah->id ? 'selected' : '' }}>{{ $matakuliah->nama_matakuliah }}</option>
                @endforeach
            </select>
            @error('matakuliah_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Dosen Dropdown -->
        <div class="form-group">
            <label for="dosen_id">Dosen</label>
            <select name="dosen_id" id="dosen_id" class="form-control @error('dosen_id') is-invalid @enderror">
                <option value="" disabled selected>Pilih Dosen</option>
                @foreach($dosens as $item)
                    <option value="{{ $item->id }}" {{ old('dosen_id') == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                @endforeach
            </select>
            @error('dosen_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Periode Dropdown -->
        <div class="form-group">
            <label for="periode_id">Periode</label>
            <select name="periode_id" id="periode_id" class="form-control @error('periode_id') is-invalid @enderror">
                <option value="" disabled selected>Pilih Periode</option>
                @foreach($periodes as $periode)
                    <option value="{{ $periode->id }}" {{ old('periode_id') == $periode->id ? 'selected' : '' }}>{{ $periode->name }}</option>
                @endforeach
            </select>
            @error('periode_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Waktu Input -->
        <div class="form-group">
            <label for="jumlah_mhs">Jumlah Mahasiswa</label>
            <input type="text" class="form-control @error('jumlah_mhs') is-invalid @enderror" name="jumlah_mhs" id="jumlah_mhs" placeholder="Masukan Jumlah Mahasiswa" value="{{ old('jumlah_mhs') }}">
            @error('jumlah_mhs')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
