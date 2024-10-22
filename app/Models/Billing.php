<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    protected $table = 'billings';
    protected $fillable = [
        'customer_user_id',
        'booking_id',
        'billing_datetime',
        'amount',
    ];
}
