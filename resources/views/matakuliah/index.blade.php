<!-- agar hanya admin yg bisa melihat -->
@if(Auth::check() && Auth::user()->role === 'admin')
@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Matakuliah') }}</h1>

    <!-- Main Content goes here -->
    <a href="{{ route('matakuliah.create') }}" class="btn btn-primary mb-3">Masukan Matakuliah Baru</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Matakuliah</th>
                <th>Nama Matakuliah</th>
                <th>Type Matakuliah</th>
                <th>Sks Praktikum</th>
                <th>Sks Teori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($matakuliahs as $index => $matakuliah)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $matakuliah->kode_matakuliah }}</td>
                <td>{{ $matakuliah->nama_matakuliah }}</td>
                <td>{{ $matakuliah->type_matakuliah }}</td>
                <td>{{ $matakuliah->semester }}</td>
                <td>{{ $matakuliah->sks }}</td>
                <td>
                    <!-- Tombol edit -->
                    <a href="{{ route('matakuliah.edit', $matakuliah->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                    
                    <!-- Form untuk aksi delete -->
                    <form action="{{ route('matakuliah.destroy', $matakuliah->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        
        {{ $matakuliahs->links() }}

    </tbody>

    </table>


@endsection
@endif