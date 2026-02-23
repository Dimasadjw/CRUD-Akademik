<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

    $semester = fake()->numberBetween(1,8);

    $huruf = fake()->randomElement(['A','B','C','D']);

        return [
            'nim'=> fake()->unique()->numerify('##########'),
            'nama' => fake()->name(),
            'kelas' => $semester . $huruf,
            'semester'=> $semester,
        ];
    }
}
