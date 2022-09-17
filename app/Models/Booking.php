<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_date',
        'booking_time_start',
        'booking_time_end',
        'venue_id',
        'price',
        'status'
    ];


}
