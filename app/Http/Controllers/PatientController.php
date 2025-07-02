<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PatientsImport;
class PatientController extends Controller
{

    public function importForm()
    {
        return view('patients.import');
    }

    

    // Proses import
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new PatientsImport, $request->file('file'));

        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil diimport!');
    }
    // Menampilkan daftar pasien + fitur search, reminder, statistik
    public function index(Request $request)
    {
        $search = $request->query('search');
        $today = Carbon::today()->toDateString();

        // Data pasien sesuai pencarian
        $patients = Patient::when($search, function ($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%');
            })
            ->orderBy('nama')
            ->paginate(10);

        // Pasien yang perlu follow-up hari ini
        $followUpToday = Patient::where('jadwal_follow_up', $today)->get();

        // Statistik
        $totalScaling = Patient::where('kebutuhan', 'Scaling')->count();
        $totalFollowUp = Patient::where('kebutuhan', 'Follow-up')->count();
        $totalPasien = Patient::count();

        return view('patients.index', compact(
            'patients',
            'search',
            'followUpToday',
            'totalScaling',
            'totalFollowUp',
            'totalPasien'
        ));
    }

    // Tampilkan form tambah pasien
    public function create()
    {
        return view('patients.create');
    }

    // Simpan data pasien baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nomor_telepon' => 'required|string|max:50',
            'kebutuhan' => 'required|string',
            'alamat' => 'required|string',
            'jadwal_follow_up' => 'nullable|date',
        ]);

        Patient::create($validated);

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    // Tampilkan form edit pasien
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    // Update data pasien
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nomor_telepon' => 'required|string|max:50',
            'kebutuhan' => 'required|string',
            'alamat' => 'required|string',
            'jadwal_follow_up' => 'nullable|date',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    // Hapus data pasien
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil dihapus.');
    }
}
