@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Jadwal') }}</h1>

    <!-- Row for Add Jadwal Button and Delete All Button -->
    <div class="row mb-3">
        <!-- Add Jadwal Button -->
        <div class="col">
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary">Tambah Jadwal Baru</a>
        </div>

        <!-- Delete All Button -->
        <div class="col">
            <form action="{{ route('jadwal.deleteAll') }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus semua jadwal?')">Hapus Semua Jadwal</button>
            </form>
        </div>

        <!-- Search Form -->
        <div class="col">
            <form action="{{ route('jadwal.index') }}" method="GET" class="d-flex">
                <input type="text" class="form-control" name="search" placeholder="Cari Matakuliah" value="{{ request()->search }}">
                <button class="btn btn-primary ml-2" type="submit">Cari</button>
            </form>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Matakuliah</th>
                <th>SKS Praktikum</th>
                <th>SKS Teori</th>
                <th>Dosen</th>
                <th>Semester</th>
                <th>Jumlah Mahasiswa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwals as $index => $jadwal)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $jadwal->matakuliah->nama_matakuliah }}</td>
                    <td>{{ $jadwal->matakuliah->semester }}</td>
                    <td>{{ $jadwal->matakuliah->sks }}</td>
                    <td>{{ $jadwal->dosen->nama }}</td>
                    <td>{{ $jadwal->periode->name }}</td>
                    <td>{{ $jadwal->jumlah_mhs }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-sm btn-primary">Edit</a>

                        <!-- Delete Button -->
                        <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin untuk menghapus jadwal ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada jadwal yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $jadwals->links() }}
    </div>

@endsection
