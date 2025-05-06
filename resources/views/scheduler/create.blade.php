@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Penjadwalan') }}</h1>

    <form action="{{ route('scheduler.store') }}" method="POST">
        @csrf

        <!-- Pilih Jadwal -->
        <div class="form-group">
            <label for="jadwal_id">Pilih Jadwal</label>
            <select name="jadwal_id" id="jadwal_id" class="form-control @error('jadwal_id') is-invalid @enderror">
                <option value="">Pilih Jadwal</option>
                @foreach($jadwals as $jadwal)
                    <option value="{{ $jadwal->id }}" {{ old('jadwal_id') == $jadwal->id ? 'selected' : '' }}>
                        {{ $jadwal->matakuliah->nama_matakuliah }} - {{ $jadwal->dosen->nama }} - {{ $jadwal->periode->name }}
                    </option>
                @endforeach
            </select>
            @error('jadwal_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pilih Ruangan -->
        <div class="form-group">
            <label for="ruangan_id">Pilih Ruangan</label>
            <select name="ruangan_id" id="ruangan_id" class="form-control @error('ruangan_id') is-invalid @enderror">
                <option value="">Pilih Ruangan</option>
                @foreach($ruangans as $ruangan)
                    <option value="{{ $ruangan->id }}" {{ old('ruangan_id') == $ruangan->id ? 'selected' : '' }}>
                        {{ $ruangan->nama_ruangan }} - {{ $ruangan->kapasitas_ruangan }} - {{ $ruangan->type_ruangan }}
                    </option>
                @endforeach
            </select>
            @error('ruangan_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pilih Hari -->
        <div class="form-group">
            <label for="hari_id">Pilih Hari</label>
            <select name="hari_id" id="hari_id" class="form-control @error('hari_id') is-invalid @enderror">
                <option value="">Pilih Hari</option>
                @foreach($haris as $hari)
                    <option value="{{ $hari->id }}" {{ old('hari_id') == $hari->id ? 'selected' : '' }}>
                        {{ $hari->hari }} ({{ $hari->kode_hari }})
                    </option>
                @endforeach
            </select>
            @error('hari_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pilih Jam -->
        <div class="form-group">
            <label for="jam_id">Pilih Jam</label>
            <select name="jam_id" id="jam_id" class="form-control @error('jam_id') is-invalid @enderror">
                <option value="">Pilih Jam</option>
                @foreach($jams as $jam)
                    <option value="{{ $jam->id }}" {{ old('jam_id') == $jam->id ? 'selected' : '' }}>
                        {{ $jam->kode_jam }} - {{ $jam->jamnya }}
                    </option>
                @endforeach
            </select>
            @error('jam_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Penjadwalan</button>
    </form>
@endsection
