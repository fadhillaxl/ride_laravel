<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Driver;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    protected $model = Driver::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'vehicle_make' => $this->faker->word,
            'vehicle_model' => $this->faker->word,
            'vehicle_year' => $this->faker->year,
            'vehicle_color' => $this->faker->colorName,
            'license_plate' => $this->faker->bothify('??-####'),
            'rating' => $this->faker->numberBetween(1, 5),
            'active' => $this->faker->boolean,
        ];
    }
}
