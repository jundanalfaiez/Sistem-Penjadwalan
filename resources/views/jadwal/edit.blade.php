@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Jadwal') }}</h1>

    <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Matakuliah Dropdown -->
        <div class="form-group">
            <label for="matakuliah_id">Matakuliah</label>
            <select name="matakuliah_id" id="matakuliah_id" class="form-control @error('matakuliah_id') is-invalid @enderror">
                @foreach($matakuliahs as $matakuliah)
                    <option value="{{ $matakuliah->id }}" {{ $jadwal->matakuliah_id == $matakuliah->id ? 'selected' : '' }}>{{ $matakuliah->nama_matakuliah }}</option>
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
                @foreach($dosens as $item)
                    <option value="{{ $item->id }}" {{ $jadwal->dosen_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
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
                @foreach($periodes as $periode)
                    <option value="{{ $periode->id }}" {{ $jadwal->periode_id == $periode->id ? 'selected' : '' }}>{{ $periode->name }}</option>
                @endforeach
            </select>
            @error('periode_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Waktu Input -->
        <div class="form-group">
            <label for="waktu">Jumlah Mahasiswa</label>
            <input type="text" class="form-control @error('jumlah_mhs') is-invalid @enderror" name="jumlah_mhs" id="jumlah_mhs" value="{{ old('jumlah_mhs', $jadwal->jumlah_mhs) }}">
            @error('jumlah_mhs')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
