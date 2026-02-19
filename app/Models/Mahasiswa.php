<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = "mahasiswa";

    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'semester',
        'bukti_pembayaran'
    ];

    public function matakuliah()
    {
        return $this->belongsToMany(MataKuliah::class, 'mahasiswa_matakuliah', 'mahasiswa_id', 'matakuliah_id');
    }
}
