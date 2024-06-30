<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'color', 'license_plate', 'number_of_passenger_seats'];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}