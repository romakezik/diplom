<?php

namespace Database\Seeders;

// database/seeders/StopSeeder.php

use App\Models\Stop;
use Illuminate\Database\Seeder;

class StopSeeder extends Seeder
{
    public function run()
    {
        Stop::factory()->count(1)->create();
    }
}

