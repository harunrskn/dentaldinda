<?php
namespace App\Exports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PatientsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Patient::select('nama', 'tanggal_lahir', 'nomor_telepon', 'kebutuhan', 'alamat')->get();
    }

    public function headings(): array
    {
        return ['Nama', 'Tanggal Lahir', 'Nomor Telepon', 'Kebutuhan', 'Alamat'];
    }
}
