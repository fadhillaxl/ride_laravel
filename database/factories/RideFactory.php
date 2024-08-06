<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ride;
use App\Models\Driver;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ride>
 */
class RideFactory extends Factory
{
    protected $model = Ride::class;

    public function definition()
    {
        return [
            'driver_id' => Driver::factory(),
            'user_id' => User::factory(),
            'pickup_latitude' => $this->faker->latitude,
            'pickup_longitude' => $this->faker->longitude,
            'dropoff_latitude' => $this->faker->latitude,
            'dropoff_longitude' => $this->faker->longitude,
            'pickup_time' => $this->faker->dateTime,
            'dropoff_time' => $this->faker->dateTime,
            'distance' => $this->faker->numberBetween(1, 100),
            'fare' => $this->faker->numberBetween(5, 100),
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected', 'completed']),
        ];
    }
}
