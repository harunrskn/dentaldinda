<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'tanggal_lahir', 'nomor_telepon', 'kebutuhan', 'alamat'];
}

