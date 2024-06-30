<?php

namespace Database\Seeders;

// database/seeders/DriverSeeder.php

use App\Models\Driver;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    public function run()
    {
        Driver::factory()->count(100)->create();
    }
}

