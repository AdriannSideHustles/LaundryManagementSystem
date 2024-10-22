<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'customer_user_id',
        'staff_user_id',
        'service_id',
        'transaction_status',
        'booking_date',
        'booking_schedule',
        'pickup_schedule'
    ];

}
