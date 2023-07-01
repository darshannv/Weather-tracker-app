<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Weather extends Model
{
    use HasFactory;

    protected $fillable = ['city', 'coordinates', 'condition', 'temperature', 'feels_like', 'humidity', 'wind_speed'];

    protected $table = 'weather';
}
