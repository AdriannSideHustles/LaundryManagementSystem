<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';

    protected $fillable = [
        'booking_refnbr',
        'customer_user_id',
        'staff_user_id',
        'service_id',
        'transaction_status',
        'booking_date',
        'booking_schedule',
        'pickup_schedule',
    ];
    protected $casts = [
        'booking_date' => 'datetime',
        'booking_schedule' => 'datetime', 
        'pickup_schedule' => 'datetime',   
    ];
    /**
     * Get the user that created the booking.
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_user_id');
    }

    /**
     * Get the staff assigned to the booking.
     */
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_user_id');
    }

    /**
     * Get the service associated with the booking.
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }


}
