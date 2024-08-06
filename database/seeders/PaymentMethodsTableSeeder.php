<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodsTableSeeder extends Seeder
{
    public function run()
    {
        PaymentMethod::factory()->count(10)->create();
    }
}
