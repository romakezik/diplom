<?php

namespace Database\Factories;

// database/factories/TicketFactory.php

use App\Models\Flight;
use App\Models\Stop;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'flight_id' => Flight::factory(),
            'entrance_stop_id' => Stop::factory(),
            'exit_stop_id' => Stop::factory(),
            'user_id' => User::factory(),
        ];
    }
}
