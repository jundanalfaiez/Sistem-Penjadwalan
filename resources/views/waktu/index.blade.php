@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Waktu') }}</h1>

    <a href="{{ route('waktu.create') }}" class="btn btn-primary mb-3">Masukan Waktu Baru</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($waktus as $index => $waktu)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $waktu->jam_mulai }}</td>
                    <td>{{ $waktu->jam_selesai }}</td>
                    <td>
                        <!-- Tombol edit -->
                        <a href="{{ route('waktu.edit', $waktu->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                        
                        <!-- Form untuk aksi delete -->
                        <form action="{{ route('waktu.destroy', $waktu->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
