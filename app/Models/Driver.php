<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone_number', 'user_id'];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
