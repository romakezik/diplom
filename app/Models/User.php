<?php
// Routes Table:

// ID
// Start_City
// End_City
// Price

// Flights Table:

// ID
// Route_ID (foreign key, refers to Routes)
// Car_ID (foreign key, refers to Cars)
// Driver_ID (foreign key, refers to Drivers)
// Departure_datetime

// Stops Table:

// ID
// Route_ID (foreign key, refers to Routes)
// Stop_Name
// Stop_Order_Number
// Aditional_time_from_departure //will be added to Flights.Departure_time to get Departure time from Stop

// Tickets Table:

// ID
// Flight_ID (foreign key, refers to Flights)
// Entrance_Stop_ID (foreign key, refers to Stops)
// Exit_Stop_ID (foreign key, refers to Stops)
// User_ID (foreign key, refers to Users)
// Cost //calculated on route price and time in flight from Entrance to Exit

// Cars Table:

// Car_ID (primary key)
// Name
// Color
// License_Plate
// Number_of_Passenger_Seats //tickets amount

// Drivers Table:

// Driver_ID (primary key)
// Name
// Phone_Number

// Users Table:

// User_ID (primary key)
// Phone_Number
// Email
// EmailVerified (boolean field)
// Password//hashed

// php artisan make:factory FlightFactory --model=Flight
// php artisan make:factory CarFactory --model=Car
// php artisan make:factory DriverFactory --model=Driver
// php artisan make:factory RouteFactory --model=Route
// php artisan make:factory StopFactory --model=Stop
// php artisan make:factory TicketFactory --model=Ticket

// php artisan make:seeder FlightTableSeeder 
// php artisan make:seeder CarTableSeeder 
// php artisan make:seeder DriverTableSeeder 
// php artisan make:seeder RouteTableSeeder
// php artisan make:seeder StopTableSeeder 
// php artisan make:seeder TicketTableSeeder 

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'phone_number',
        'user_type',
        'email_verified_at' 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'user_type'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function driver()
{
    return $this->hasOne(Driver::class);
}

}
