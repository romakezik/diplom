<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    use HasFactory;
    protected $fillable = ['route_id', 'stop_name', 'stop_order_number', 'additional_time_from_departure'];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function entrance_tickets()
    {
        return $this->hasMany(Ticket::class, 'entrance_stop_id');
    }

    public function exit_tickets()
    {
        return $this->hasMany(Ticket::class, 'exit_stop_id');
    }
}

