<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = ['route_id', 'car_id', 'driver_id', 'departure_datetime', 'available_seats'];

    protected $dates = ['departure_datetime'];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}