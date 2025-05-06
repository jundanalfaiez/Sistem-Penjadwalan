@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Edit Matakuliah') }}</h1>

    <!-- Form untuk mengedit data Matakuliah -->
    <form action="{{ route('matakuliah.update', $matakuliah->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Kode Mata Kuliah -->
    <div class="form-group">
        <label for="kode_matakuliah">Kode Mata Kuliah</label>
        <input type="text" name="kode_matakuliah" id="kode_matakuliah" 
               class="form-control" 
               value="{{ old('kode_matakuliah', $matakuliah->kode_matakuliah) }}" required>
    </div>

    <!-- Nama Mata Kuliah -->
    <div class="form-group">
        <label for="nama_matakuliah">Nama Mata Kuliah</label>
        <input type="text" name="nama_matakuliah" id="nama_matakuliah" 
               class="form-control" 
               value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}" required>
    </div>

    <!-- Type Mata Kuliah -->
    <div class="form-group">
        <label for="type_matakuliah">Type Mata Kuliah</label>
        <select name="type_matakuliah" id="type_matakuliah" class="form-control" required>
            <option value="" disabled>Pilih Type</option>
            @foreach ($typeMatakuliahOptions as $option)
                <option value="{{ $option }}" 
                    {{ old('type_matakuliah', $matakuliah->type_matakuliah) == $option ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Semester -->
    <div class="form-group">
        <label for="semester">SKS Praktikum</label>
        <input type="number" name="semester" id="semester" 
               class="form-control" 
               value="{{ old('semester', $matakuliah->semester) }}" required>
    </div>

    <!-- SKS -->
    <div class="form-group">
        <label for="sks">SKS</label>
        <input type="number" name="sks" id="sks" 
               class="form-control" 
               value="{{ old('sks', $matakuliah->sks) }}" required>
    </div>

    <!-- Tombol Simpan -->
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</form>

    <!-- <form action="{{ route('matakuliah.update', $matakuliah->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kode_matakuliah">Kode Matakuliah</label>
            <input type="text" class="form-control" id="kode_matakuliah" name="kode_matakuliah" value="{{ $matakuliah->kode_matakuliah }}">
        </div>

        <div class="form-group">
            <label for="nama_matakuliah">Nama Matakuliah</label>
            <input type="text" class="form-control" id="nama_matakuliah" name="nama_matakuliah" value="{{ $matakuliah->nama_matakuliah }}">
        </div>

        <div class="form-group">
            <label for="type_matakuliah">Type Matakuliah</label>
            <input type="text" class="form-control" id="type_matakuliah" name="type_matakuliah" value="{{ $matakuliah->type_matakuliah }}">
        </div>

        <div class="form-group">
            <label for="semester">Semester</label>
            <input type="text" class="form-control" id="semester" name="semester" value="{{ $matakuliah->semester }}">
        </div>

        <div class="form-group">
            <label for="sks">SKS</label>
            <input type="text" class="form-control" id="sks" name="sks" value="{{ $matakuliah->sks }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Kembali</a>
    </form> -->
    <!-- End of Form -->


@endsection
