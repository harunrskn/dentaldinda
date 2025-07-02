@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Edit Data Pasien</h2>

    <form method="POST" action="{{ route('patients.update', $patient->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pasien</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $patient->nama) }}" required>
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir', $patient->tanggal_lahir) }}" required>
            @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" name="nomor_telepon" value="{{ old('nomor_telepon', $patient->nomor_telepon) }}" required>
            @error('nomor_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="kebutuhan" class="form-label">Kebutuhan Pasien</label>
            <select class="form-select @error('kebutuhan') is-invalid @enderror" name="kebutuhan" required>
                <option value="">-- Pilih Kebutuhan --</option>
                <option value="Scaling" {{ old('kebutuhan', $patient->kebutuhan) == 'Scaling' ? 'selected' : '' }}>Scaling</option>
                <option value="Follow-up" {{ old('kebutuhan', $patient->kebutuhan) == 'Follow-up' ? 'selected' : '' }}>Follow-up</option>
                <option value="Tambal Gigi" {{ old('kebutuhan', $patient->kebutuhan) == 'Tambal Gigi' ? 'selected' : '' }}>Tambal Gigi</option>
            </select>
            @error('kebutuhan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" required>{{ old('alamat', $patient->alamat) }}</textarea>
            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="jadwal_follow_up" class="form-label">Jadwal Follow-Up</label>
            <input type="date" class="form-control @error('jadwal_follow_up') is-invalid @enderror" name="jadwal_follow_up" value="{{ old('jadwal_follow_up', $patient->jadwal_follow_up) }}">
            @error('jadwal_follow_up') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Pasien</button>
        <a href="{{ route('patients.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
