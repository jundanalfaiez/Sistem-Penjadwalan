@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Periode') }}</h1>

    <!-- Add Period Button -->
    <a href="{{ route('periode.create') }}" class="btn btn-primary mb-3">Tambah Periode Baru</a>

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
                <th>Periode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($periodes as $index => $periode)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $periode->name }}</td>
                <td>
                    <!-- Edit Button -->
                    <a href="{{ route('periode.edit', $periode->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>

                    <!-- Delete Button -->
                    <form action="{{ route('periode.destroy', $periode->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin untuk menghapus periode ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
