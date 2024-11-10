<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentMonitoring extends Model
{
    use HasFactory;
    protected $table = 'equipment_monitorings';
    protected $fillable = [
        'staff_user_id',
        'equipment_id',
        'monitoring_date',
        'equipment_status',
    ];
    protected $casts = [
        'monitoring_date' => 'datetime',
    ];

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_user_id');
    }
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }
}
