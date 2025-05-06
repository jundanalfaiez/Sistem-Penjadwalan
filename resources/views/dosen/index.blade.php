@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Dosen') }}</h1>

    <!-- Main Content goes here -->

    <a href="{{ route('dosen.create') }}" class="btn btn-primary mb-3">Masukan Dosen Baru</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>NIP Dosen</th>
                <th>Nama Dosen</th>
                <!-- <th>Matakuliah diampu</th> -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through your data and populate the table -->
            @foreach($dosen as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->nama }}</td>
                    <!-- <td>{{ $item->matakuliahnya }}</td> -->
                    <td>
                        <!-- Your action buttons (Edit and Delete) here -->
                        <a href="{{ route('dosen.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <form action="{{ route('dosen.destroy', $item->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- End of Main Content -->
@endsection

@push('notif')
    <!-- Your notification content -->
@endpush
