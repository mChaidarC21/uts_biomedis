<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\medical_record;
use Faker\Factory as Faker;

class MedicalRecordSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $patients = Patient::all();
        $doctors = Doctor::all();

        if ($patients->isEmpty() || $doctors->isEmpty()) {
            $this->command->info('Please seed patients and doctors before running MedicalRecordSeeder.');
            return;
        }

        foreach (range(1, 10) as $index) {
            medical_record::create([
                'patient_id' => $patients->random()->id,
                'doctor_id' => $doctors->random()->id,
                'record_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'blood_type' => $faker->randomElement(['A', 'B', 'AB', 'O']),
                'blood_pressure' => $faker->randomElement(['120/80', '130/85', '140/90', '110/70']),
                'complaint' => $faker->sentence(6),
                'diagnosa' => $faker->sentence(4),
                'treatment' => $faker->sentence(8),
            ]);
        }
    }
}

