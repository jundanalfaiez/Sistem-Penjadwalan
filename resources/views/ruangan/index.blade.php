@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Ruangan') }}</h1>

    <!-- Main Content goes here -->

    <a href="{{ route('ruangan.create') }}" class="btn btn-primary mb-3">Masukan Ruangan Baru</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Ruangan</th>
                <th>Nama Ruangan</th>
                <th>Kapasitas Ruangan</th>
                <th>Type Ruangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
    @foreach($ruangan as $index => $ruangan)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $ruangan->kode_ruangan }}</td>
            <td>{{ $ruangan->nama_ruangan }}</td>
            <td>{{ $ruangan->kapasitas_ruangan }}</td>
            <td>{{ $ruangan->type_ruangan }}</td>
            <td>
                <a href="{{ route('ruangan.edit', $ruangan->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="POST" style="display: inline-block;">
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
