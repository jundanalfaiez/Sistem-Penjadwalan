@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Dosen</h1>

    <!-- Form untuk tambah dosen -->
    <form action="{{ route('dosen.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nip">NIP Dosen</label>
            <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP Dosen">
        </div>
        <div class="form-group">
            <label for="nama">Nama Dosen</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Dosen">
        </div>
        <!-- <div class="form-group">
            <label for="matakuliahnya">Matakuliah Diampu</label>
            <input type="text" class="form-control" id="matakuliahnya" name="matakuliahnya" placeholder="Matakuliah yang Diampu">
        </div> -->
        <!-- Tambahkan input lainnya sesuai kebutuhan -->

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('dosen.index') }}" class="btn btn-default">Back to list</a>
    </form>

    <!-- End of Main Content -->
@endsection

@push('notif')
    <!-- Your notification content -->
@endpush
