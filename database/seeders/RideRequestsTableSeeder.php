<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RideRequest;

class RideRequestsTableSeeder extends Seeder
{
    public function run()
    {
        RideRequest::factory()->count(10)->create();
    }
}
