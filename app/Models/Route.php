<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $fillable = ['start_city', 'end_city', 'price'];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }

    public function stops()
    {
        return $this->hasMany(Stop::class);
    }
}