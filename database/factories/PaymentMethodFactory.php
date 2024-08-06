<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PaymentMethod;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    protected $model = PaymentMethod::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'cash']),
            'payment_details' => $this->faker->creditCardNumber,
        ];
    }
}
