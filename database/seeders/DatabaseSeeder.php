<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Availability;
use App\Models\Dentist;
use App\Models\Location;
use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(5)->create();
        Dentist::factory()->count(10)->create();
        Service::factory()->count(20)->create();
        Location::factory()->count(10)->create();
        Availability::factory()->count(10)->create();
        Appointment::factory()->count(10)->create();
    }
}
