@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Pasien</h2>
    <div>
        <a href="{{ route('patients.create') }}" class="btn btn-primary">Tambah Pasien</a>
    </div>
</div>

{{-- Statistik --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-bg-primary shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Pasien</h5>
                <p class="card-text fs-4">{{ $totalPasien }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-success shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Scaling</h5>
                <p class="card-text fs-4">{{ $totalScaling }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-warning shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Follow-up</h5>
                <p class="card-text fs-4">{{ $totalFollowUp }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Reminder Follow-up --}}
@if($followUpToday->count() > 0)
<div class="alert alert-warning shadow-sm">
    <strong>Reminder Follow-up Hari Ini:</strong>
    <ul class="mb-0">
        @foreach($followUpToday as $p)
            <li>{{ $p->nama }} - {{ \Carbon\Carbon::parse($p->jadwal_follow_up)->format('d M Y') }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Search & Import --}}
<div class="card mb-4 shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <form method="GET" class="d-flex w-50" role="search">
            <input class="form-control me-2" type="search" name="search" placeholder="Cari nama pasien..." value="{{ $search }}">
            <button class="btn btn-outline-light btn-sm" type="submit">Cari</button>
        </form>
        <form action="{{ route('patients.import') }}" method="POST" enctype="multipart/form-data" class="d-flex">
            @csrf
            <input type="file" name="file" class="form-control form-control-sm me-2" required>
            <button class="btn btn-success btn-sm">Import Excel</button>
        </form>
    </div>

    {{-- Tabel Pasien --}}
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-primary">
                <tr>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Telepon</th>
                    <th>Kebutuhan</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>{{ $p->nomor_telepon }}</td>
                    <td>{{ $p->kebutuhan }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>
                        <a href="{{ route('patients.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('patients.destroy', $p->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus pasien ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Data pasien tidak ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        {{ $patients->withQueryString()->links() }}
    </div>
</div>
@endsection
