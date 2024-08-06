<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RideRequest;
use App\Models\Ride;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RideRequest>
 */
class RideRequestFactory extends Factory
{
    protected $model = RideRequest::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'ride_id' => Ride::factory(),
            'request_time' => $this->faker->dateTime,
        ];
    }
}
