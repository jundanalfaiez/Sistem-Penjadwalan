@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">Data Matakuliah</h1>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('data-matakuliah.create') }}" class="btn btn-primary mb-3">Tambah Data Matakuliah</a>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Jumlah Mahasiswa</th>
                        <th>Periode</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataMatakuliah as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->matakuliah->nama_matakuliah }}</td>
                            <td>{{ $item->dosen->nama_dosen }}</td>
                            <td>{{ $item->jumlah_mahasiswa }}</td>
                            <td>{{ $item->periode->name }}</td>
                            <td>
                                <a href="{{ route('data-matakuliah.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('data-matakuliah.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
