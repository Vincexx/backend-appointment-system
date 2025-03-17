<?php

namespace Database\Factories;

use App\Models\Availability;
use App\Models\Dentist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Availability>
 */
class AvailabilityFactory extends Factory
{
    protected $model = Availability::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = $this->faker->time('H:i:s');
        $endTime = date('H:i:s', strtotime($startTime) + rand(3600, 7200)); // Adds 1 to 2 hours

        return [
            'dentist_id' => Dentist::factory(),
            'date' => $this->faker->date,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
