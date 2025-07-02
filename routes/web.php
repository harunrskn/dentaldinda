<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Exports\PatientsExport;
use Maatwebsite\Excel\Facades\Excel;

// Route default halaman index pasien
Route::get('/', [PatientController::class, 'index']);
Route::resource('patients', PatientController::class)->except(['show']);

Route::get('/patients/import', [PatientController::class, 'importForm'])->name('patients.import.form');
Route::post('/patients/import', [PatientController::class, 'import'])->name('patients.import');

// Route Export Excel
Route::get('/patients/export/excel', function () {
    return Excel::download(new PatientsExport, 'data_pasien.xlsx');
})->name('patients.export');
