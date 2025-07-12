<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_barang',
        'jumlah',
        'total_harga',
        'tanggal_diperlukan',
        'keterangan',
        'status_kepsek',
        'alasan_kepsek',
        'status_admin',
        'alasan_admin',
    ];

    // Optional: relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
