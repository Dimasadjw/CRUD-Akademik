<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = "mata_kuliah";

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
    ];

    public function mahasiswa(){
       return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_matakuliah', 'matakuliah_id', 'mahasiswa_id');
    }
}
