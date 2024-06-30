<?php

namespace Database\Seeders;

// database/seeders/TicketSeeder.php

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run()
    {
        Ticket::factory()->count(1)->create();
    }
}

