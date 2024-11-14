<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        foreach (range(1, 10) as $index) {
            $schedule = [
                'Senin' => $faker->time('H:i') . '-' . $faker->time('H:i', '12:00'),
                'Selasa' => $faker->time('H:i', '13:00') . '-' . $faker->time('H:i', '17:00'),
                'Rabu' => $faker->time('H:i', '08:00') . '-' . $faker->time('H:i', '17:00'),
                'Kamis' => $faker->time('H:i', '09:30') . '-' . $faker->time('H:i', '17:00'),
                'Jumat' => $faker->time('H:i', '10:00') . '-' . $faker->time('H:i', '17:00'),
            ];
        
            DB::table('doctors')->insert([
                'name' => $faker->name,
                'specialist' => $faker->randomElement(['Penyakit Dalam', 'Anak', 'Bedah', 'Gigi', 'Jantung', 'THT', 'Gizi Klinik']),
                'number' => $faker->phoneNumber,
                'schedule' => json_encode($schedule),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }        
    }
}
