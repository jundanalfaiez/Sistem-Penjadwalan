@extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@section('main-content')
 <!-- Page Heading -->
 <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Masukan Matakuliah Baru') }}</h1>

<!-- Main Content goes here -->

<div class="card">
    <div class="card-body">
        <form action="{{ route('matakuliah.store') }}" method="post">
            @csrf

            <div class="form-group">
              <label for="kode_matakuliah">Kode Matakuliah</label>
              <input type="text" class="form-control @error('kode_matakuliah') is-invalid @enderror" name="kode_matakuliah" id="kode_matakuliah" placeholder="Kode Matakuliah" autocomplete="off" value="{{ old('kode_matakuliah') }}">
              @error('kode_matakuliah')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="nama_matakuliah">Nama Matakuliah</label>
              <input type="text" class="form-control @error('nama_matakuliah') is-invalid @enderror" name="nama_matakuliah" id="nama_matakuliah" placeholder="Nama Matakuliah" autocomplete="off" value="{{ old('nama_matakuliah') }}">
              @error('nama_matakuliah')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
                <label for="type_matakuliah">Type Mata Kuliah</label>
                <select name="type_matakuliah" id="type_matakuliah" class="form-control">
                    <option value="" disabled selected>Pilih Type</option>
                    @foreach ($typeMatakuliahOptions as $option)
                        <option value="{{ $option }}" {{ old('type_matakuliah') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
              <label for="semester">SKS Praktikum</label>
              <input type="text" class="form-control @error('semester') is-invalid @enderror" name="semester" id="semester" placeholder="Semester" autocomplete="off" value="{{ old('semester') }}">
              @error('semester')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="sks">SKS Teori</label>
              <input type="text" class="form-control @error('sks') is-invalid @enderror" name="sks" id="sks" placeholder="Sks" autocomplete="off" value="{{ old('sks') }}">
              @error('sks')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('matakuliah.index') }}" class="btn btn-default">Back to list</a>

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
