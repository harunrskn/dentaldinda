<?php

namespace App\Imports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class PatientsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Patient([
            'nama'           => $row['nama'],
            'tanggal_lahir'  => Carbon::parse($row['tanggal_lahir'])->format('Y-m-d'),
            'nomor_telepon'  => $row['nomor_telepon'],
            'kebutuhan'      => $row['kebutuhan'],
            'alamat'         => $row['alamat'],
            'jadwal_follow_up' => isset($row['jadwal_follow_up']) 
                                    ? Carbon::parse($row['jadwal_follow_up'])->format('Y-m-d') 
                                    : null,
        ]);
    }
}