<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        foreach (range(1, 10) as $index) {
        $dateOfBirth = $faker->date('Y-m-d', '-20 years');
        $age = \Carbon\Carbon::parse($dateOfBirth)->age;

        DB::table('patients')->insert([
            'name' => $faker->name,
            'gender' => $faker->randomElement(['Male', 'Female']),
            'date_of_birth' => $dateOfBirth,
            'age' => $age,
            'number' => $faker->phoneNumber,
            'address' => $faker->address,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    }
}