<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'venue_type_id',
        'court_id',
        'venue_price',
        'start_hour',
        'end_hour',
        'rest_days'
    ];
}
