<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matakuliah>
 */
class MatakuliahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $index = 1;

        $daftar_matkul = [
            'Pemrograman Web',
            'Struktur Data',
            'Algoritma & Pemrograman',
            'Sistem Operasi',
            'Matematika Diskrit',
            'Kalkulus',
            'Pengantar Teknologi Informasi',
            'Bahasa Inggris Teknik',
            'Arsitektur Komputer',
            'Logika Informatika',
            'Jaringan Komputer',
            'Basis Data',
            'Sistem Cerdas',
            'Grafika Komputer',
            'Pemrograman Berorientasi Objek',
            'Rekayasa Perangkat Lunak',
            'Interaksi Manusia & Komputer',
            'Sistem Informasi',
            'Statistika & Probabilitas',
            'Analisis Algoritma',
            'Keamanan Siber',
            'Big Data',
            'Kriptografi',
            'Cloud Computing',
            'Data Mining',
            'Pemrograman Mobile',
            'Internet of Things (IoT)',
            'Sistem Terdistribusi',
            'Machine Learning',
            'Kecerdasan Buatan',
            'Tata Kelola TI',
            'Manajemen Proyek TI',
            'Etika Profesi',
            'Technopreneurship',
            'Metodologi Penelitian',
            'Kapita Selekta',
            'Audit Sistem Informasi',
            'Bahasa Indonesia',
            'Pendidikan Kewarganegaraan',
            'Skripsi/Tugas Akhir'
        ];
        
        $nama_mk = $daftar_matkul[$index - 1] ?? fake()->sentence(2);
        $semester = ceil($index / 5);
        $semester = $semester > 8 ? 8 : $semester;

        $kode_mk = 'MK' . str_pad($index, 3, '0', STR_PAD_LEFT);

        $index++;

        return [
            'kode_mk'  => $kode_mk,
            'nama_mk'  => $nama_mk,
            'sks'      => fake()->randomElement([2, 3, 4]),
            'semester' => (int)$semester,
        ];
    }
}
