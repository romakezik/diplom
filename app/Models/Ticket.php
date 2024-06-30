<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = ['flight_id', 'entrance_stop_id', 'exit_stop_id', 'user_id','price', 'status'];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function entrance_stop()
    {
        return $this->belongsTo(Stop::class, 'entrance_stop_id');
    }

    public function exit_stop()
    {
        return $this->belongsTo(Stop::class, 'exit_stop_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}