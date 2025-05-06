@extends('layouts.admin')

@section('main-content')
 <!-- Page Heading -->
 <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Masukan Ruangan Baru') }}</h1>

<!-- Main Content goes here -->

<div class="card">
    <div class="card-body">
        <form action="{{ route('ruangan.store') }}" method="post">
            @csrf

            <div class="form-group">
              <label for="kode_ruangan">Kode Ruangan</label>
              <input type="text" class="form-control @error('kode_ruangan') is-invalid @enderror" name="kode_ruangan" id="kode_ruangan" placeholder="Kode Ruangan" autocomplete="off" value="{{ old('kode_ruangan') }}">
              @error('name')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="nama_ruangan">Nama Ruangan</label>
              <input type="text" class="form-control @error('nama_ruangan') is-invalid @enderror" name="nama_ruangan" id="nama_ruangan" placeholder="Nama Ruangan" autocomplete="off" value="{{ old('nama_ruangan') }}">
              @error('last_name')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="kapasitas_ruangan">Kapasitas Ruangan</label>
              <input type="text" class="form-control @error('kapasitas_ruangan') is-invalid @enderror" name="kapasitas_ruangan" id="kapasitas_ruangan" placeholder="kapasitas Ruangan" autocomplete="off" value="{{ old('kapasitas_ruangan') }}">
              @error('last_name')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            
            <div class="form-group">
              <label for="type_ruangan">Type Ruangan</label>
              <input type="text" class="form-control @error('type_ruangan') is-invalid @enderror" name="type_ruangan" id="type_ruangan" placeholder="Type Ruangan" autocomplete="off" value="{{ old('type_ruangan') }}">
              @error('last_name')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <!-- <div class="form-group">
              <label for="email">Semester</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" autocomplete="off" value="{{ old('email') }}">
              @error('email')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="password">Jumlah SKS</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" autocomplete="off"value="{{ old('password') }}">
              @error('password')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div> -->

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('ruangan.index') }}" class="btn btn-default">Back to list</a>

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
