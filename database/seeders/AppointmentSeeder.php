<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Faker\Factory as Faker;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $faker = Faker::create();

        $patients = Patient::all();
        $doctors = Doctor::all();

        if ($patients->count() == 0 || $doctors->count() == 0) {
            $this->command->info('Please seed patients and doctors before running AppointmentSeeder.');
            return;
        }

        foreach (range(1, 10) as $index) {
            Appointment::create([
                'patient_id' => $patients->random()->id,
                'doctor_id' => $doctors->random()->id,
                'appointment_date' => $faker->dateTimeBetween('now', '+1 month'),
                'status' => $faker->randomElement(['scheduled', 'completed', 'canceled']),
            ]);
        }
    }
}

