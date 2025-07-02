@extends('layout')

@section('content')
<h4>{{ isset($patient) ? 'Edit Pasien' : 'Tambah Pasien' }}</h4>

<form method="POST" action="{{ isset($patient) ? route('patients.update', $patient->id) : route('patients.store') }}">
    @csrf
    @if(isset($patient)) @method('PUT') @endif

    <div class="mb-3">
    <label>Jadwal Follow-Up</label>
    <input type="date" name="jadwal_follow_up" class="form-control" value="{{ old('jadwal_follow_up', $patient->jadwal_follow_up ?? '') }}">
</div>

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $patient->nama ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $patient->tanggal_lahir ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label>Nomor Telepon</label>
        <input type="text" name="nomor_telepon" class="form-control" value="{{ old('nomor_telepon', $patient->nomor_telepon ?? '') }}" required>
    </div>
    <div class="mb-3">
    <label for="kebutuhan" class="form-label">Kebutuhan Pasien</label>
    <select class="form-select @error('kebutuhan') is-invalid @enderror" name="kebutuhan" required>
        <option value="">-- Pilih Kebutuhan --</option>
        <option value="Scaling" {{ old('kebutuhan', $patient->kebutuhan ?? '') == 'Scaling' ? 'selected' : '' }}>Scaling</option>
        <option value="Follow-up" {{ old('kebutuhan', $patient->kebutuhan ?? '') == 'Follow-up' ? 'selected' : '' }}>Follow-up</option>
        <option value="Cabut Gigi" {{ old('kebutuhan', $patient->kebutuhan ?? '') == 'Cabut Gigi' ? 'selected' : '' }}>Cabut Gigi</option>
        <option value="Tambal Gigi" {{ old('kebutuhan', $patient->kebutuhan ?? '') == 'Tambal Gigi' ? 'selected' : '' }}>Tambal Gigi</option>
    </select>
    @error('kebutuhan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" required>{{ old('alamat', $patient->alamat ?? '') }}</textarea>
    </div>
    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('patients.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
