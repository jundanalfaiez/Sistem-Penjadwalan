@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Data Dosen</h1>

    <!-- Form untuk edit dosen -->
    <form action="{{ route('dosen.update', $dosen->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nip">NIP Dosen</label>
            <input type="text" class="form-control" id="nip" name="nip" value="{{ $dosen->nip }}">
        </div>
        <div class="form-group">
            <label for="nama">Nama Dosen</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $dosen->nama }}">
        </div>
        <!-- <div class="form-group">
            <label for="matakuliahnya">Matakuliah Diampu</label>
            <input type="text" class="form-control" id="matakuliahnya" name="matakuliahnya" value="{{ $dosen->matakuliahnya }}">
        </div> -->
        <!-- Tambahkan input lainnya sesuai kebutuhan -->

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

    <!-- End of Main Content -->
@endsection

@push('notif')
    <!-- Your notification content -->
@endpush
