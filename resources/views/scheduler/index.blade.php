@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Jadwal Terbaik') }}</h1>
    <form method="POST" action="{{ route('scheduler.index') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Generate Jadwal</button>
            <a href="{{ route('scheduler.export') }}" class="btn btn-success">Export ke Excel</a>
            <a href="{{ route('scheduler.export.pdf') }}" class="btn btn-primary">Unduh PDF</a>

            <p class="mt-2 text-muted">Jadwal akan dibuat berdasarkan data yang tersedia.</p>
        </form>
    <!-- Flash Messages -->
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(isset($schedule) && count($schedule) > 0)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- <h6 class="m-0 font-weight-bold text-primary">Jadwal Terbaik (Generasi: {{ $generation }})</h6> -->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Matakuliah</th>
                                <th>Type Mata Kuliah</th>
                                <th>Dosen</th>
                                <th>Semester</th>
                                <th>Ruang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedule as $item)
                            <tr>
                                <td>{{ $item['hari'] }}</td>
                                <td>{{ $item['waktu'] }}</td>
                                <td>{{ $item['matakuliah'] }}</td>
                                <td>{{ $item['type_matakuliah'] }}</td>
                                <td>{{ $item['dosen'] }}</td>
                                <td>{{ $item['periode'] }}</td>
                                <td>{{ $item['ruangan'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else

    @endif
</div>
@endsection
