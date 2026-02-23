<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $matkuls = \App\Models\MataKuliah::factory(40)->create();
        Mahasiswa::factory(60)->create()->each(function ($mhs) use ($matkuls) {

            $matkulSesuai = $matkuls->where('semester', $mhs->semester);

            if ($matkulSesuai->count() > 0) {
                $mhs->mataKuliah()->attach($matkulSesuai->pluck('id'));
            }
        });

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
