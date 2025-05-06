@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Jam') }}</h1>

    <!-- Main Content goes here -->

    <a href="{{ route('jam.create') }}" class="btn btn-primary mb-3">Masukan Jam Baru</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Jam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($jams as $index => $jam)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $jam->kode_jam }}</td>
                <td>{{ $jam->jamnya }}
                <td>
                    <!-- Tombol edit -->
                    <a href="{{ route('jam.edit', $jam->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                    
                    <!-- Form untuk aksi delete -->
                    <form action="{{ route('jam.destroy', $jam->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>

    </table>

    <!-- End of Main Content -->
@endsection
