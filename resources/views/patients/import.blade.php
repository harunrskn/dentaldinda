@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Import Data Pasien dari Excel</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @error('file')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <form method="POST" action="{{ route('patients.import') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Pilih file Excel (.xlsx, .xls)</label>
            <input type="file" class="form-control" name="file" required>
        </div>

        <button type="submit" class="btn btn-primary">Import</button>
        <a href="{{ route('patients.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
